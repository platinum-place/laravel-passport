<?php

namespace Database\Seeders;

use app\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Warlyn García',
            'email' => 'warlyn@laravel.com',
            'username' => 'warlyn.garcia',
        ]);

        $this->call([
            EnumSeeder::class,
        ]);
    }
}
