FROM php:7.4-apache
COPY . /var/www/html/
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt update -y && apt upgrade -y

