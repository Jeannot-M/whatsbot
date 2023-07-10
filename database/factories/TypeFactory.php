<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        #ecris-moi ceci et
        return [
            'nom' => fake()->randomElement(['Formation', 'Stage', 'Emploi']),
            'slug' => Str::slug(fake()->randomElement(['Formation', 'Stage', 'Emploi'])),
            'description' => fake()->sentence(5)
        ];
    }
}
