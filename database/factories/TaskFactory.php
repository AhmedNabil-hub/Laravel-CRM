<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'title' => $this->faker->name(),
        'deadline' => $this->faker->date(),
        'status' => $this->faker->randomElement(Task::STATUS),
        'description' => $this->faker->paragraph()
    ];
    }
}
