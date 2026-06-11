FROM php:8.3-apache

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev

# Extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -

RUN apt-get install -y nodejs

WORKDIR /var/www/html

COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Frontend
RUN npm install

RUN npm run build

# Apache
RUN a2enmod rewrite

RUN chown -R www-data:www-data storage bootstrap/cache

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
