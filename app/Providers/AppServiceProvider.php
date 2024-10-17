<?php

namespace app\Providers;

use App\Models\Passport\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;
use Exception;
use Laravel\Passport\Token;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Symfony\Component\HttpFoundation\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addHour());
        Passport::useClientModel(Client::class);

        Auth::viaRequest('passport', function (Request $request) {
            $tokenId = Configuration::forSymmetricSigner(new Sha256, InMemory::plainText('empty', 'empty'))
                ->parser()
                ->parse($request->bearerToken())
                ->claims()
                ->get('jti');

            $token = Token::find($tokenId);

            if (empty($token)) {
                throw new Exception(__('Client not found.'));
            }

            $request->merge([
                'client' => $token->client,
                'client_id' => $token->client->id,
            ]);

            return $token->client;
        });
    }
}
