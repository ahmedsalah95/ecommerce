FROM php:8.2.13-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mysqli zip \
    && a2enmod rewrite

COPY . /var/www/html


WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

COPY .env.example .env

RUN php artisan key:generate

EXPOSE 80
CMD ["apache2-foreground"]
