# Usamos una imagen de PHP con Apache
FROM php:8.1-apache

# Instalamos extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiamos todo el contenido del proyecto al contenedor
COPY . /var/www/html/

# Exponemos el puerto 80
EXPOSE 80
