<?php

namespace Database\Seeders;

use App\Models\{Admin, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'm.darabkhan@codedistrict.com',
        ]);

        User::factory(100)->create();
    }
}
