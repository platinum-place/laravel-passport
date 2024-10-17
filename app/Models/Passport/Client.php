<?php

namespace App\Models\Passport;

use App\Models\Company;
use App\Observers\Passport\ClientObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\Client as PassportClient;

#[ObservedBy([ClientObserver::class])]
class Client extends PassportClient
{
    use SoftDeletes;

    protected $hidden = [];
}
