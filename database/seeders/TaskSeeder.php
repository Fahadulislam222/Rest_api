<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task; // Ensure you're using the correct Task model
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->count(10)->create(); // Correct way to call factory
    }
}
