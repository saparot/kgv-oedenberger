FROM dunglas/frankenphp:1.2-php8.1

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zlib1g-dev libpq-dev \
 && docker-php-ext-install intl opcache zip \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Prod-Build
RUN composer install --no-dev --optimize-autoloader --no-interaction \
 && php bin/console cache:clear --env=prod \
 && php bin/console assets:install --symlink --relative

# Caddy/FrankenPHP-Config (Symfony preset)
# see https://frankenphp.dev/docs/symfony (Kurzfassung):
RUN printf "\
{
  auto_https off
}\n\
:8080 {\n\
  encode zstd gzip\n\
  root * /app/public\n\
  php_server\n\
  file_server\n\
}\n" > /usr/local/etc/caddy/Caddyfile

# Health/Expose
EXPOSE 8080

# Start through Base-Image (FrankenPHP/Caddy)
