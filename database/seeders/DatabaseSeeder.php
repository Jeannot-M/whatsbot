<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Utilisateur::factory(50)->create();
        \App\Models\User::factory(50)->create();
        Type::factory(26)->create();
        \App\Models\Spectacle::factory(50)->create();
        \App\Models\Transaction::factory(50)->create();
        \App\Models\Billet::factory(50)->create();

    }
}
