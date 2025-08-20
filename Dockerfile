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

# Copier les fichiers de l'application
COPY . .

# Installer les dépendances Composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Créer la base de données SQLite et configurer les permissions
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod 755 storage bootstrap/cache && \
    chmod 644 database/database.sqlite

# Générer la clé d'application
RUN php artisan key:generate --force

# Exécuter les migrations et seeds
RUN php artisan migrate --force
RUN php artisan db:seed --force

# Optimiser l'application
RUN php artisan optimize
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exposer le port
EXPOSE 8000

# Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]