<?php

namespace Database\Factories;

use App\Models\User; // Corrected namespace
use App\Models\Task;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(), // Ensure user exists
            'content' => $this->faker->realText(100),
            'is_finished' => $this->faker->boolean(),
            'finished_at' => $this->faker->randomElement([null, now()]),
        ];
    }
}
