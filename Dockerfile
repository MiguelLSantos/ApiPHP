# Usar a imagem oficial do PHP
FROM php:8.1-cli

# Instalar o SQLite
RUN docker-php-ext-install pdo pdo_sqlite
