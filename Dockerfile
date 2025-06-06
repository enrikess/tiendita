FROM php:8.3-apache

# Instala dependencias del sistema y extensiones PHP recomendadas para Laravel
RUN apt-get update && \
    apt-get install -y unzip git libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev libpq-dev libjpeg-dev libfreetype6-dev libssl-dev curl libsodium-dev && \
    docker-php-ext-install pdo pdo_mysql zip gd intl opcache sodium pcntl && \
    a2enmod rewrite

# Cambia el DocumentRoot de Apache a /var/www/html/public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Instala Node.js y npm (para soporte frontend en el contenedor app)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest vite && \
    npm install -g @vitejs/plugin-vue

# Crea las carpetas necesarias para permisos de Laravel
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Instala Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Instala el instalador global de Laravel
RUN composer global require laravel/installer

# Agrega la ruta global de Composer al PATH
ENV PATH="/root/.composer/vendor/bin:$PATH"
ENV PATH="/usr/local/share/.config/yarn/global/node_modules/.bin:/usr/local/lib/node_modules/.bin:${PATH}"
# Corrige permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html