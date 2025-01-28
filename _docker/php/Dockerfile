FROM php:8.3-fpm-alpine

ARG PUID=1000
ARG PGID=1000

RUN apk --no-cache add bash shadow postgresql-dev autoconf make zlib-dev \
    && docker-php-ext-install pdo_pgsql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && groupmod -o -g ${PGID} www-data \
    && usermod -o -u ${PUID} -g www-data www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]
