# PHP + Composer image kullanıyoruz
FROM php:8.2-fpm

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring zip

# Composer kur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www

# Laravel dosyalarını kopyala
COPY . .

# Composer bağımlılıklarını yükle
RUN composer install

# Storage ve cache izinleri
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
