
FROM php:8.2-fpm

# Install system dependencies including nginx
RUN apt-get update && apt-get install -y \
    nginx libpq-dev libonig-dev libxml2-dev curl zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy your application code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy nginx configuration
COPY nginx.conf /etc/nginx/sites-enabled/default

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start nginx and php-fpm together
CMD service nginx start && php-fpm
