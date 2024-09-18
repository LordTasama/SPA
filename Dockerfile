# Usa una imagen base de PHP con Apache
FROM php:7.4-apache
# Instala extensiones de PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Copia el contenido del directorio actual en el contenedor
COPY . /var/www/html/