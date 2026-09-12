FROM php:8.2-apache

# Habilitar módulo de reescritura de URLs de Apache
RUN a2enmod rewrite

# Copiar todos los archivos del repositorio al directorio de Apache
COPY . /var/www/html/

# Configurar permisos para la lectura de los archivos JSON y vistas
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
