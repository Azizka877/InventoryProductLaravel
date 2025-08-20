<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 50 produits fictifs
        Product::factory()->count(50)->create();
    }
}
