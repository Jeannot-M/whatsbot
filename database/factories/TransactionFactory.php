<?php

namespace Database\Factories;

use App\Models\Billet;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_transaction' => $this->faker->numberBetween(100000, 999999),
            'billet_id' => Billet::factory(),
            'utilisateur_id' => Utilisateur::factory(),
            'montant' => $this->faker->numberBetween(100, 1000),
            'methode_paiement' => $this->faker->randomElement(['M-Pesa', 'Airtel-Money', 'Orange']),
        ];
    }
}
