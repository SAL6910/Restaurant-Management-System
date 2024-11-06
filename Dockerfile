FROM php:8.0-apache
WORKDIR /var/www/html/
RUN apt update && apt install iputils-ping -y && docker-php-ext-install mysqli
EXPOSE 80


