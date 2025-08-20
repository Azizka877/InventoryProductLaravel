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

        // Créer des fournisseurs réalistes AVEC LES BONNES COLONNES
        $supplier1 = Supplier::create([
            'name' => 'AgriSupply Centre',
            'email' => 'contact@agrisupply.com',       // ✅ email au lieu de contact
            'phone_number' => '+1 555-0123',           // ✅ phone_number au lieu de phone
            'address' => '123 Farm Road, Ruralville'
        ]);

        $supplier2 = Supplier::create([
            'name' => 'Animal Health Pro',
            'email' => 'sales@animalhealth.com',       // ✅ email
            'phone_number' => '+1 555-0456',           // ✅ phone_number
            'address' => '456 Veterinary Ave, Farmtown'
        ]);

        $supplier3 = Supplier::create([
            'name' => 'Premium Feed Co',
            'email' => 'orders@premiumfeed.com',       // ✅ email
            'phone_number' => '+1 555-0789',           // ✅ phone_number
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

        Product::create([
            'name' => 'Broyeur à Céréales 500kg/h',
            'description' => 'Broyeur électrique pour céréales. Capacité 500kg par heure.',
            'price' => 1250.00,
            'quantity' => 5,
            'supplier_id' => $supplier1->id
        ]);

        Product::create([
            'name' => 'Complément Minéral Ovin',
            'description' => 'Bloc à lécher pour ovins. Riches en oligo-éléments. 20kg.',
            'price' => 32.75,
            'quantity' => 80,
            'supplier_id' => $supplier3->id
        ]);

        Product::create([
            'name' => 'Thermomètre Digital Animal',
            'description' => 'Thermomètre vétérinaire digital. Lecture rapide, étanche.',
            'price' => 24.99,
            'quantity' => 35,
            'supplier_id' => $supplier2->id
        ]);

        Product::create([
            'name' => 'Bétaillère Galvanisée',
            'description' => 'Bétaillère 6m³ pour transport bovin. Structure galvanisée.',
            'price' => 4200.00,
            'quantity' => 3,
            'supplier_id' => $supplier1->id
        ]);

        Product::create([
            'name' => 'Insémination Artificielle Bovine',
            'description' => 'Kit complet insémination artificielle pour bovins. Stérile.',
            'price' => 156.80,
            'quantity' => 25,
            'supplier_id' => $supplier2->id
        ]);

        Product::create([
            'name' => 'Foin de Luzerne Premium',
            'description' => 'Ballé rond de foin de luzerne 1ère coupe. 400kg.',
            'price' => 120.00,
            'quantity' => 15,
            'supplier_id' => $supplier3->id
        ]);

        $this->command->info('✅ Données réalistes créées avec succès');
        $this->command->info('👤 Admin: admin@farm.com / admin123');
    }
}