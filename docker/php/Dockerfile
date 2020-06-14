FROM php:7.4-fpm-alpine

WORKDIR /web

RUN apk --update add libzip-dev

RUN docker-php-ext-install pdo_mysql exif pcntl bcmath zip

COPY ./php-entrypoint.sh /entrypoint.sh

RUN chmod a+x /entrypoint.sh

CMD /entrypoint.sh
