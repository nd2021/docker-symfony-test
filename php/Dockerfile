FROM php:7.4-fpm-alpine

# пакет установки расширений для php
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# необходимые расширения php
RUN install-php-extensions \
    bcmath \
    exif \
    gd \
    imagick \
    intl \
    mysqli \
    opcache \
    pdo_mysql \
    zip

RUN install-php-extensions @composer

RUN apk add --no-cache nodejs npm \
    && npm install --global yarn

RUN apk add --no-cache git rsync openssh

# исправление работы библиотеки iconv в alphine
RUN apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

# установка xdebug и профилировщика
RUN apk add --no-cache graphviz
RUN install-php-extensions xhprof xdebug
COPY conf.d/xdebug.ini $PHP_INI_DIR/conf.d/
COPY conf.d/xhprof.ini $PHP_INI_DIR/conf.d/

# расширенные настройки php
COPY php-development.ini $PHP_INI_DIR/php.ini
COPY conf.d/opcache-recommended.ini $PHP_INI_DIR/conf.d/
COPY conf.d/error-logging.ini $PHP_INI_DIR/conf.d/

# расширенные настройки php-fpm
COPY php-fpm.d/advanced.conf /usr/local/etc/php-fpm.d/www.conf

CMD ["php-fpm"]
