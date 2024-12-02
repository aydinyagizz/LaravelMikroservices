#FROM php:8.2-fpm-alpine
#
#RUN docker-php-ext-install pdo pdo_mysql
#RUN curl -sS https://getcomposer.org/installer | php -- \
#        --install-dir=/usr/local/bin --filename=composer
#
#WORKDIR /app
#COPY . .
#RUN composer install
#
#CMD php artisan serve --host=0.0.0.0



FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Create necessary directories
RUN mkdir -p \
    /var/www/html/bootstrap/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/logs

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

# Copy composer files
COPY composer.* ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy all files
COPY . .

# Final permission setup
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache

# Generate autoload files
RUN composer dump-autoload --optimize \
    && php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]


