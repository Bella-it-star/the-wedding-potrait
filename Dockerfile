FROM php:8.2-apache

# 1. Install tool pembantu instalasi ekstensi PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# 2. Install ekstensi PHP yang mutlak dibutuhkan Laravel & MySQL
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql mbstring zip exif pcntl bcmath gd xml

# 3. Aktifkan modul Rewrite Apache (Penting agar routing Laravel tidak 404)
RUN a2enmod rewrite

# 4. Arahkan Document Root Apache langsung ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Salin semua file kodingan kamu ke dalam server
COPY . /var/www/html

# 6. Install Composer resmi & pasang dependensi Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 7. Atur izin akses folder agar tidak error Permission Denied
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Buka port standar web
EXPOSE 80

# 9. Jalankan migrasi database otomatis dan hidupkan server Apache
CMD php artisan migrate --force && apache2-foreground