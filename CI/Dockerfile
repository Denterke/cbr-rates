FROM php:8.1.0-fpm
# Set working directory
WORKDIR /var/www
# Install dependencies
RUN apt-get update && apt-get install -y \
    nano \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www
#Composer
RUN chmod -R 775 /var/www/storage
RUN composer install  && \
    composer dumpautoload -o

#laravel cache and optimization
RUN php artisan optimize && \
    php artisan route:cache && \
    php artisan config:cache && \
    php artisan scribe:generate

# Change current user to root
USER root
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]