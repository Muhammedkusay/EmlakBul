# ----------------------------
# 🧱 1. Backend Stage (PHP + Composer)
# ----------------------------
FROM php:8.2-fpm as backend

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

# Laravel cache setup
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# ----------------------------
# 🎨 2. Frontend Stage (Vite + Tailwind)
# ----------------------------
FROM node:18-alpine as frontend

WORKDIR /app
COPY . .

RUN npm install && npm run build

# ----------------------------
# 🚀 3. Production Stage (Nginx + PHP-FPM)
# ----------------------------
FROM php:8.2-fpm

# Install nginx and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx libpq-dev libonig-dev libxml2-dev curl unzip zip git \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy backend (Laravel code)
COPY --from=backend /var/www/html /var/www/html

# Copy compiled assets from frontend
COPY --from=frontend /app/public/build /var/www/html/public/build

# Copy nginx configuration
COPY nginx.conf /etc/nginx/sites-enabled/default

# Set proper permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 for Render
EXPOSE 80

# Start nginx and php-fpm
CMD service nginx start && php-fpm
