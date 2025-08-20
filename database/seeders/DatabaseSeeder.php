<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

         // Créer 5 fournisseurs
         Supplier::factory(5)->create();

         // Créer 50 produits et les associer aléatoirement aux fournisseurs
         Product::factory(50)->create();
    }
}
