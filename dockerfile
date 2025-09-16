# PHP + Composer image
FROM php:8.2-fpm

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libzip-dev \
    zip \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd \
        --with-jpeg \
        --with-webp \
        --with-xpm \
        --with-freetype \
    && docker-php-ext-install pdo_mysql mbstring zip exif gd

# Composer kur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www

# Laravel dosyalarını kopyala
COPY . .

# Composer bağımlılıklarını yükle
RUN composer install

# Storage linkini oluştur ve izinleri ayarla
RUN php artisan storage:link || true && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
