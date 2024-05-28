FROM php:8.3-fpm

# Define o nome de usuário e UID do usuário não-root dentro do contêiner
ARG user=yourusername
ARG uid=1000

# Instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpa o cache do apt-get
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala as extensões PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria um usuário não-root dentro do contêiner
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Define as permissões do diretório de trabalho
RUN chown -R $user:www-data /var/www \
    && chmod -R 755 /var/www

# Instala o Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Define o diretório de trabalho
WORKDIR /var/www

# Copia as configurações PHP personalizadas
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Define o usuário não-root como o usuário padrão para comandos futuros
USER $user
