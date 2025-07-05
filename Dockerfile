# Use official PHP 8.1 FPM image
FROM php:8.1-fpm

# Install system dependencies and PHP extensions needed for Laravel & PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer (dependency manager for PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy all project files to working directory
COPY . .

# Install PHP dependencies (without dev for production)
RUN composer install

# Generate optimized autoload files (optional, composer does this in --optimize-autoloader)
RUN composer dump-autoload -o

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
