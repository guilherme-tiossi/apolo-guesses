FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN chmod +x .docker/local/entrypoint.sh