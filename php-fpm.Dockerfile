# syntax=docker.io/docker/dockerfile-upstream:1.6.0

ARG PHP_VERSION=8.3
ARG COMPOSER_VERSION=2.7

FROM composer:${COMPOSER_VERSION} as composer
FROM php:${PHP_VERSION}-fpm as dev

# Fetch composer
COPY --link --from=composer /usr/bin/composer /usr/local/bin/composer

# https://github.com/moby/buildkit/blob/master/frontend/dockerfile/docs/reference.md#example-cache-apt-packages
RUN rm -f /etc/apt/apt.conf.d/docker-clean && \
    echo 'Binary::apt::APT::Keep-Downloaded-Packages "true";' > /etc/apt/apt.conf.d/keep-cache;
RUN --mount=type=cache,target=/var/cache/apt,sharing=locked \
    --mount=type=cache,target=/var/lib/apt,sharing=locked \
    apt update && \
    apt-get --no-install-recommends install -y \
    git zlib1g-dev libpng-dev libzip-dev libicu-dev \
    libcurl4-openssl-dev libonig-dev && \
    docker-php-ext-install mysqli gd pdo pdo_mysql zip intl mbstring curl

FROM dev as prd
COPY --link src /var/www/html