# ----------------------------
# 🐘 Backend Stage: Laravel PHP + Composer
# ----------------------------
FROM php:8.2-fpm AS backend

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring tokenizer xml ctype bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# ----------------------------
# ⚡ Frontend Stage: Vite + Tailwind + FilePond/Flowbite
# ----------------------------
FROM node:18-alpine AS frontend

WORKDIR /app
COPY . .

# Install and build frontend assets
RUN npm install && npm run build

# ----------------------------
# 🚀 Final Production Image
# ----------------------------
FROM php:8.2-fpm

# Reinstall PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring tokenizer xml ctype bcmath

# Install Composer again
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy built Laravel backend from backend stage
COPY --from=backend /var/www/html /var/www/html

# Copy compiled frontend assets from frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port for Render
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
