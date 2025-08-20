<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 fournisseurs fictifs
        Supplier::factory()->count(10)->create();
    }
}
