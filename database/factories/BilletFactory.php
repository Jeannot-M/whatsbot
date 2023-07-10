<?php

namespace Database\Factories;

use App\Models\Spectacle;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billet>
 */
class BilletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //ecris-moi ici les champs de la table billets dans la base de données masta_bot (les champs qui ne sont pas des clés étrangères)
            'code_billet' => $this->faker->numberBetween(100000, 999999),
            'spectacle_id' => Spectacle::factory(),
            'utilisateur_id' => Utilisateur::factory(),
            'price' => $this->faker->numberBetween(20, 65),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->numberBetween(1, 10),
            'is_reserved' => $this->faker->boolean(),
        ];
    }
}
