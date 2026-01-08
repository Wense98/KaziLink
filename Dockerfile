FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libatomic1 \
    ca-certificates \
    && update-ca-certificates

# Configure PHP for SSL and Uploads
RUN echo "openssl.cafile=/etc/ssl/certs/ca-certificates.crt" >> /usr/local/etc/php/conf.d/docker-php-config.ini && \
    echo "openssl.capath=/etc/ssl/certs/" >> /usr/local/etc/php/conf.d/docker-php-config.ini && \
    echo "upload_max_filesize=100M" >> /usr/local/etc/php/conf.d/docker-php-config.ini && \
    echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/docker-php-config.ini && \
    echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/docker-php-config.ini

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Build-time environment variables to prevent DB connection
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=:memory:
ENV DEBIAN_FRONTEND=noninteractive

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN npm install
RUN npm run build

# Run scripts after building assets, still isolated from real DB
RUN php artisan package:discover --ansi

# Set permissions
RUN chmod +x docker-start.sh
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8080

CMD ["sh", "docker-start.sh"]
