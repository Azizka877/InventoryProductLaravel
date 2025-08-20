FROM php:8.2-alpine

# Installer les dépendances système nécessaires
RUN apk add --no-cache \
    curl \
    git \
    zip \
    unzip \
    sqlite-dev

# Installer les extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo pdo_sqlite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html
COPY .env.docker .env

# Copier les fichiers de l'application
COPY . .

# Créer le fichier .env depuis .env.example
RUN cp .env.example .env

# Installer les dépendances Composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Créer la base de données SQLite et configurer les permissions
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod 755 storage bootstrap/cache && \
    chmod 644 database/database.sqlite

# Générer la clé d'application
RUN php artisan key:generate --force

# Exécuter les migrations
RUN php artisan migrate --force

# Créer des données réalistes pour l'élevage (Livestock)
RUN php artisan tinker --execute="\
    // Créer l'administrateur\
    \App\Models\User::create([\
        'name' => 'Administrateur Farm',\
        'email' => 'admin@farm.com',\
        'password' => bcrypt('admin123'),\
        'email_verified_at' => now()\
    ]);\
    \
    // Créer des fournisseurs réalistes\
    \$supplier1 = \App\Models\Supplier::create([\
        'name' => 'AgriSupply Centre',\
        'contact' => 'contact@agrisupply.com',\
        'phone' => '+1 555-0123',\
        'address' => '123 Farm Road, Ruralville'\
    ]);\
    \
    \$supplier2 = \App\Models\Supplier::create([\
        'name' => 'Animal Health Pro',\
        'contact' => 'sales@animalhealth.com',\
        'phone' => '+1 555-0456',\
        'address' => '456 Veterinary Ave, Farmtown'\
    ]);\
    \
    \$supplier3 = \App\Models\Supplier::create([\
        'name' => 'Premium Feed Co',\
        'contact' => 'orders@premiumfeed.com',\
        'phone' => '+1 555-0789',\
        'address' => '789 Grain Street, Agricity'\
    ]);\
    \
    // Créer des produits réalistes pour l'élevage\
    \App\Models\Product::create([\
        'name' => 'Aliment pour Bovins Premium',\
        'description' => 'Aliment complet 18% protéines pour bovins de boucherie. Sac de 25kg.',\
        'price' => 45.99,\
        'quantity' => 200,\
        'supplier_id' => \$supplier3->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Vaccin Bovin Multivalent',\
        'description' => 'Vaccin pour maladies respiratoires bovines. Boîte de 10 doses.',\
        'price' => 89.50,\
        'quantity' => 50,\
        'supplier_id' => \$supplier2->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Broyeur à Céréales 500kg/h',\
        'description' => 'Broyeur électrique pour céréales. Capacité 500kg par heure.',\
        'price' => 1250.00,\
        'quantity' => 5,\
        'supplier_id' => \$supplier1->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Complément Minéral Ovin',\
        'description' => 'Bloc à lécher pour ovins. Riches en oligo-éléments. 20kg.',\
        'price' => 32.75,\
        'quantity' => 80,\
        'supplier_id' => \$supplier3->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Thermomètre Digital Animal',\
        'description' => 'Thermomètre vétérinaire digital. Lecture rapide, étanche.',\
        'price' => 24.99,\
        'quantity' => 35,\
        'supplier_id' => \$supplier2->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Bétaillère Galvanisée',\
        'description' => 'Bétaillère 6m³ pour transport bovin. Structure galvanisée.',\
        'price' => 4200.00,\
        'quantity' => 3,\
        'supplier_id' => \$supplier1->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Insémination Artificielle Bovine',\
        'description' => 'Kit complet insémination artificielle pour bovins. Stérile.',\
        'price' => 156.80,\
        'quantity' => 25,\
        'supplier_id' => \$supplier2->id\
    ]);\
    \
    \App\Models\Product::create([\
        'name' => 'Foin de Luzerne Premium',\
        'description' => 'Ballé rond de foin de luzerne 1ère coupe. 400kg.',\
        'price' => 120.00,\
        'quantity' => 15,\
        'supplier_id' => \$supplier3->id\
    ]);\
    \
    echo '✅ Données réalistes créées avec succès';\
    echo '👤 Admin: admin@farm.com / admin123';\
    "

# Optimiser l'application pour la production
RUN php artisan optimize
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exposer le port
EXPOSE 8000

# Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]