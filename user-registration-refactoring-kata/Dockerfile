FROM php:7.2

MAINTAINER Luis Rovirosa <luisrovirosa@gmail.com>

# Composer and dependencies
RUN apt-get update && \
    apt-get install git unzip zlib1g zlib1g-dev -y
    
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install zip && docker-php-ext-enable zip
RUN pecl install xdebug-2.6.1 && docker-php-ext-enable xdebug


# Volume to have access to the source code
VOLUME ["/opt/project"]

WORKDIR /opt/project