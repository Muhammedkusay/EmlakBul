# ----------------------------
# 🐘 Backend Stage: Laravel PHP + Composer
# ----------------------------
FROM php:8.2-fpm

# Install required PHP extensions (without tokenizer)
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

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

# Reinstall PHP extensions (without tokenizer)
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

# Install Composer again
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy backend code from backend stage
COPY --from=0 /var/www/html /var/www/html

# Copy frontend build assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
