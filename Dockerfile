FROM php:8.2-fpm

# Instalar extensões e dependências do Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

# Gerar key
RUN php artisan key:generate
