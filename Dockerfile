# Use the official PHP Apache image
FROM php:8.1-apache

# Copy your PHP files into the Apache document root
COPY . /var/www/html/

# (Optional) Enable Apache mod_rewrite if your application needs it
RUN a2enmod rewrite

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
