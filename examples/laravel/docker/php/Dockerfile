FROM php:7.2.2-fpm

# RUN pecl install swoole \
#     && docker-php-ext-install pdo_mysql \
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json \
    && apt-get update \
    && apt-get install git -y \
    && pecl install protobuf-3.5.1 -y