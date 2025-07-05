# -------------------------
# Build stage (for assets)
# -------------------------
FROM node:18 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources resources
COPY vite.config.js .
COPY tailwind.config.js .
COPY postcss.config.js .
COPY public public

RUN npm run build

# -------------------------
# Backend stage
# -------------------------
FROM php:8.2-fpm

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev nginx \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

# Set working dir
WORKDIR /var/www/html

# Copy Laravel project
COPY . .

# Ensure views are copied explicitly (critical!)
COPY resources/views resources/views
COPY resources/lang resources/lang

# Copy built frontend assets
COPY --from=frontend /app/public/build public/build

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose HTTP port
EXPOSE 80

# Start Laravel and services
CMD php artisan config:cache \
 && php artisan route:cache \
 && service nginx start \
 && php-fpm