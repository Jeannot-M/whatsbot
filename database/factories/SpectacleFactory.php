<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spectacle>
 */
class SpectacleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'date' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'image' => $this->faker->imageUrl(640, 480, 'spectacles', true),
            'slug' => Str::slug($this->faker->sentence(3)),
            'type_id' => Type::factory(),
            'lieu' => $this->faker->city(),
            'compagnie' => $this->faker->company(),
            'is_premium' => $this->faker->boolean(),
            'user_id' => User::factory(),
        ];
    }
}
