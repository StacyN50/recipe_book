FROM php:8.2-apache

# Enable mysqli (important for MySQL apps)
RUN docker-php-ext-install mysqli

# Copy app into Apache root
COPY . /var/www/html/

# Enable Apache rewrite (optional but recommended)
RUN a2enmod rewrite

# IMPORTANT: Render uses PORT env variable
ENV APACHE_PORT 80

EXPOSE 80

# Run Apache in foreground (critical)
CMD ["apache2-foreground"]

ENV PORT=80
