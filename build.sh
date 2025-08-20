#!/bin/bash

# Script de build pour Render.com
# Ce script sera exécuté automatiquement lors du déploiement

echo "🚀 Début du processus de build..."

# Installer les dépendances Composer
echo "📦 Installation des dépendances Composer..."
composer install --optimize-autoloader --no-dev --no-interaction

# Créer le dossier database s'il n'existe pas
echo "📁 Création du dossier database..."
mkdir -p database

# Créer la base de données SQLite
echo "🗄️ Création de la base de données SQLite..."
touch database/database.sqlite

# Configurer les permissions nécessaires
echo "🔐 Configuration des permissions..."
chmod 755 database
chmod 644 database/database.sqlite

# Vérifier si une clé d'application existe déjà, sinon en générer une
if [ -z "$APP_KEY" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
else
    echo "🔑 Clé d'application déjà configurée"
fi

# Exécuter les migrations de base de données
echo "🔄 Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders pour peupler la base de données
echo "🌱 Exécution des seeders..."
php artisan db:seed --force

# Optimiser l'application pour la production
echo "⚡ Optimisation de l'application..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Nettoyer le cache (au cas où)
echo "🧹 Nettoyage du cache..."
php artisan cache:clear
php artisan view:clear

echo "✅ Build terminé avec succès!"