# ---------- 1) Composer (sin scripts) ----------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction --no-scripts
COPY . .
RUN composer dump-autoload --optimize

# ---------- 2) Runtime PHP-FPM ----------
FROM php:8.3-fpm-alpine AS runtime
RUN apk add --no-cache icu-dev oniguruma-dev libzip-dev postgresql-dev libpng-dev jpeg-dev freetype-dev bash \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) pdo_pgsql pgsql mbstring gd zip intl bcmath opcache

# OpCache prod
RUN { \
  echo "opcache.enable=1"; \
  echo "opcache.enable_cli=0"; \
  echo "opcache.memory_consumption=256"; \
  echo "opcache.interned_strings_buffer=16"; \
  echo "opcache.max_accelerated_files=20000"; \
  echo "opcache.validate_timestamps=0"; \
} > /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/html
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=vendor /app/bootstrap ./bootstrap

RUN addgroup -g 1000 laravel && adduser -D -G laravel -u 1000 laravel \
 && mkdir -p storage bootstrap/cache \
 && chown -R laravel:laravel storage bootstrap/cache \
 && php artisan config:cache || true \
 && php artisan route:cache || true \
 && php artisan view:cache || true

USER laravel
EXPOSE 9000
CMD ["php-fpm"]
