FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    unzip \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install mbstring pgsql pdo_pgsql intl zip
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]