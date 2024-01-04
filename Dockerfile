FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    openssl \
    libssl-dev \
    libcurl4-openssl-dev \
    supervisor \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

# Clear cache
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copy code
COPY --chown=www-data:www-data . /var/www

# Add root to www group
RUN chmod -R ug+w /var/www/storage

# Copy nginx/php/supervisor configs
RUN cp docker-compose/supervisor.conf /etc/supervisord.conf
RUN cp docker-compose/php.ini /usr/local/etc/php/conf.d/app.ini

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Ensure dependencies aren't copied
RUN rm -rf node_modules vendor

# Deployment steps
RUN composer install --optimize-autoloader
RUN npm install
# Vite build
RUN npm run build

# Set run script executable
RUN chmod +x /var/www/docker-compose/run.sh

EXPOSE 80
ENTRYPOINT ["/var/www/docker-compose/run.sh"]