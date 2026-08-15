FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js postcss.config.js tailwind.config.js ./
RUN npm run build

FROM php:8.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip pkg-config \
        libsqlite3-dev libzip-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_sqlite zip mbstring xml curl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && mkdir -p database public/storage/products \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database public/storage

EXPOSE 10000

CMD php artisan migrate --force \
    && php artisan db:seed --force \
    && php artisan config:cache \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
