# Stage 1: Build frontend assets
FROM node:20 as node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# Stage 2: Laravel with PHP-FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        mbstring \
        xml \
        ctype \
        bcmath \
        zip \
        gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application source
COPY . .

# Copy built frontend assets
COPY --from=node-builder /app/public/build ./public/build

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Install PHP dependencies and cache config
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan route:cache \

EXPOSE 6543
CMD php artisan serve --host=0.0.0.0 --port=6543
