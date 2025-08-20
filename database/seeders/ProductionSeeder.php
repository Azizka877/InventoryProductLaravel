<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'administrateur
        User::create([
            'name' => 'Administrateur Farm',
            'email' => 'admin@farm.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now()
        ]);

        // Créer des fournisseurs réalistes
        $supplier1 = Supplier::create([
            'name' => 'AgriSupply Centre',
            'contact' => 'contact@agrisupply.com',
            'phone' => '+1 555-0123',
            'address' => '123 Farm Road, Ruralville'
        ]);

        $supplier2 = Supplier::create([
            'name' => 'Animal Health Pro',
            'contact' => 'sales@animalhealth.com',
            'phone' => '+1 555-0456',
            'address' => '456 Veterinary Ave, Farmtown'
        ]);

        $supplier3 = Supplier::create([
            'name' => 'Premium Feed Co',
            'contact' => 'orders@premiumfeed.com',
            'phone' => '+1 555-0789',
            'address' => '789 Grain Street, Agricity'
        ]);

        // Créer des produits réalistes pour l'élevage
        Product::create([
            'name' => 'Aliment pour Bovins Premium',
            'description' => 'Aliment complet 18% protéines pour bovins de boucherie. Sac de 25kg.',
            'price' => 45.99,
            'quantity' => 200,
            'supplier_id' => $supplier3->id
        ]);

        Product::create([
            'name' => 'Vaccin Bovin Multivalent',
            'description' => 'Vaccin pour maladies respiratoires bovines. Boîte de 10 doses.',
            'price' => 89.50,
            'quantity' => 50,
            'supplier_id' => $supplier2->id
        ]);

        // Ajoutez les autres produits de la même manière...
        
        $this->command->info('✅ Données réalistes créées avec succès');
        $this->command->info('👤 Admin: admin@farm.com / admin123');
    }
}