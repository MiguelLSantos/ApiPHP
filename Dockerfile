# Usar uma imagem oficial do PHP
FROM php:8.1-cli

# Instalar o SQLite
RUN docker-php-ext-install pdo pdo_sqlite

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /app

# Copiar o código da aplicação
COPY . .

# Executar o Composer para instalar as dependências
RUN composer install

# Definir o comando padrão
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]
