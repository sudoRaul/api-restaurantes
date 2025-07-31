FROM php:8.2-apache

# Instalar extensiones necesarias de PHP y herramientas del sistema
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Activar mod_rewrite
RUN a2enmod rewrite

# Copiar configuración de Apache personalizada
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de Laravel
COPY . .

# Copiar Composer desde su imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorios necesarios y establecer permisos
RUN mkdir -p storage/framework/views \
 && mkdir -p storage/framework/cache/data \
 && mkdir -p storage/logs \
 && chown -R www-data:www-data /var/www/html \
 && find storage -type d -exec chmod 775 {} \; \
 && find storage -type f -exec chmod 664 {} \; \
 && chmod -R 775 bootstrap/cache

# Instalar dependencias PHP sin las de desarrollo y optimizar autoload
RUN composer install --no-dev --optimize-autoloader

# Generar documentación de Scribe (asegúrate de tener configurado Scribe correctamente)
RUN php artisan scribe:generate

# Exponer el puerto
EXPOSE 80
