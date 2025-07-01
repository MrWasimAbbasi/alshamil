# Use official PHP 8.3 image with Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Install system packages and PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev sqlite3 libsqlite3-dev nodejs npm \
    && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd zip

# Install Composer (copied from composer container)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory to Laravel root
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Fix public directory for Apache
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copy and prepare fix-permissions.sh
COPY fix-permissions.sh /usr/local/bin/fix-permissions.sh
RUN chmod +x /usr/local/bin/fix-permissions.sh


## Ensure default permission
#RUN chown -R www-data:www-data /var/www/html \
#    && chmod -R 755 /var/www/html

# Expose Apache port
EXPOSE 80

# Run startup script on container launch
CMD ["/usr/local/bin/fix-permissions.sh"]
