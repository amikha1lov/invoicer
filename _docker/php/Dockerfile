FROM php:8.3-fpm-alpine

ARG PUID=1000
ARG PGID=1000

RUN apk --no-cache add bash shadow postgresql-dev rabbitmq-c-dev autoconf make zlib-dev  \
    && pecl install amqp \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable amqp \
    && groupmod -o -g ${PGID} www-data \
    && usermod -o -u ${PUID} -g www-data www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./php.ini /usr/local/etc/php/conf.d/php-custom.ini

RUN echo "extension=amqp.so" > /usr/local/etc/php/conf.d/amqp.ini

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]
