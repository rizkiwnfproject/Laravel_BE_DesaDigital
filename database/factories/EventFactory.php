<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thumbnail' => $this->faker->imageUrl(),
            'name' => $this->faker->randomElement(['Belajar Bahasa Ingrris', 'Kerja Bakti', 'Posyandu']). ' ' . $this->faker->city(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1000000, 100000000),
            'date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'time' => $this->faker->time(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
