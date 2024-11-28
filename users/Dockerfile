FROM php:8.2-fpm-alpine

# Sistem bağımlılıkları
RUN apk add --no-cache git curl libpng-dev oniguruma-dev libxml2-dev zip unzip

# PHP uzantıları
RUN docker-php-ext-install pdo pdo_mysql

# Composer kurulumu
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www/html

# Dosyaları kopyalama
COPY . .

# Basit izin ayarlama
RUN chmod -R 755 /var/www/html

# Bağımlılıkları yükleme
RUN composer install --no-dev --no-scripts --no-autoloader

# Autoload
#RUN composer dump-autoload --optimize

EXPOSE 8000

CMD ["php-fpm"]
