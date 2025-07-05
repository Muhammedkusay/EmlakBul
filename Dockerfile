FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpq-dev libonig-dev libxml2-dev nginx \
    && docker-php-ext-install pdo pdo_pgsql mbstring xml ctype bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs \
    && npm install && npm run build

COPY nginx.conf /etc/nginx/sites-enabled/default

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD php artisan config:cache \
 && php artisan route:cache \
 && service nginx start \
 && php-fpm
