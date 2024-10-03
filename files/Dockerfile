# Use a imagem base do PHP com FPM
FROM php:8.2-fpm-alpine

# Instala as dependências do sistema e extensões do PHP
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    zlib-dev \
    libxml2-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql xml \
    && apk del libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev zlib-dev libxml2-dev

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o restante dos arquivos do projeto
COPY ./api /var/www/html

# Instala as dependências do Composer
RUN composer install --no-scripts --no-autoloader

# Adiciona as permissões corretas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expondo a porta 9000
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]