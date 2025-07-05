# -----------------------------------
# 🧱 1. Backend Stage (Composer + Laravel)
# -----------------------------------
FROM php:8.2-fpm as backend

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

# -----------------------------------
# 🎨 2. Frontend Stage (Vite + Tailwind)
# -----------------------------------
FROM node:18-alpine as frontend

WORKDIR /app
COPY . .

RUN npm install && npm run build

# -----------------------------------
# 🚀 3. Final Stage (PHP-FPM + Nginx)
# -----------------------------------
FROM php:8.2-fpm

# Install Nginx and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx libpq-dev libonig-dev libxml2-dev curl unzip zip git \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy backend Laravel app
COPY --from=backend /var/www/html /var/www/html

# Copy frontend compiled assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Copy Nginx config
COPY nginx.conf /etc/nginx/sites-enabled/default

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose HTTP port
EXPOSE 80

# 🧠 Laravel caches run at runtime, after app is ready
CMD php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && service nginx start \
 && php-fpm
