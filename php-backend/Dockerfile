# php-backend/Dockerfile
FROM php:8.2-apache

# Update system packages to address vulnerabilities
RUN apt-get update && apt-get upgrade -y && apt-get clean

# Enable php-extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy php files into apache root
COPY . /var/www/html/

EXPOSE 80