<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'module_id' => Module::factory(),
            'name' => $this->faker->unique()->name,
            'video' => $this->faker->unique()->name,
            'description' => $this->faker->sentence(10),
        ];
    }
}
