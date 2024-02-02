FROM php:8.3-fpm

# Fetch composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Run php-fpm with all the required extensions
RUN apt update \
    && apt install -y git zlib1g-dev libpng-dev libzip-dev libicu-dev \
                      libcurl4-openssl-dev libonig-dev \
    && docker-php-ext-install mysqli gd pdo pdo_mysql zip intl mbstring curl