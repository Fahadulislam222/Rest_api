<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create normal users
        User::factory(10)->create();

        // Create an admin user using the admin state
        User::factory()->admin()->create();
    }
}
