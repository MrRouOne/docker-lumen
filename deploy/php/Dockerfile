FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev  \
    build-essential \
    libpng-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    curl \
    zip \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git

# Install extensions
RUN docker-php-ext-install pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd  --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#CMD bash -c "composer install"