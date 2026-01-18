FROM php:8.4-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mysqli \
        mbstring \
        zip \
        exif \
        pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Expose Laravel port
EXPOSE 8000

# Default command (handled by docker-compose)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
