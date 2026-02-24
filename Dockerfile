# Authenticity - CodeIgniter 3 (PHP 7.4)
# Fokus ke framework, database menggunakan MySQL di host/WSL
FROM php:7.4-apache

RUN a2enmod rewrite

# System dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions untuk CodeIgniter + Google API library
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql mysqli mbstring xml zip bcmath opcache gd

# Apache: ServerName + DirectoryIndex (index.php) untuk CodeIgniter
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY apache-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copy project
COPY . .

# Set permissions untuk cache dan logs
RUN chown -R www-data:www-data application/cache application/logs application/config \
    && chmod -R 775 application/cache application/logs

# PHP production optimizations (OPcache)
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80
