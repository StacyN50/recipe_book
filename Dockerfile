FROM php:8.2-apache

# Install PostgreSQL + MySQL extensions (safe combo)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mysqli

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
