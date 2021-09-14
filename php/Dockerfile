FROM alpine:3.13

RUN apk add --no-cache \
    coreutils \
    gettext \
    php7-fpm \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-gd \
    php7-iconv \
    php7-json \
    php7-intl \
    php7-fileinfo\
    php7-mbstring \
    php7-opcache \
    php7-openssl \
    php7-pdo \
    php7-pdo_mysql \
    php7-mysqli \
    php7-xml \
    php7-xsl \
    php7-zlib \
    php7-phar \
    php7-tokenizer \
    php7-session \
    php7-simplexml \
    php7-zip \
    php7-xmlwriter \
    php7-sodium \
    php7-pecl-apcu \
    make \
    curl

# Enable php7-xdebug if $PHP_XDEBUG_MODE is not empty
ARG PHP_XDEBUG_MODE=off
ARG PHP_XDEBUG_CLIENT_PORT=5902
ARG PHP_XDEBUG_CLIENT_HOST=host.docker.internal
COPY xdebug.ini  /etc/php7/conf.d/xdebug.ini.template
RUN if [[ "$PHP_XDEBUG_MODE" != "" ]]; then \
        apk add --no-cache php7-pecl-xdebug; \
        export PHP_XDEBUG_MODE=$PHP_XDEBUG_MODE; \
        export PHP_XDEBUG_CLIENT_PORT=$PHP_XDEBUG_CLIENT_PORT; \
        export PHP_XDEBUG_CLIENT_HOST=$PHP_XDEBUG_CLIENT_HOST; \
        envsubst < /etc/php7/conf.d/xdebug.ini.template > /etc/php7/conf.d/xdebug.ini; \
    fi
RUN rm -f /etc/php7/conf.d/xdebug.ini.template

RUN curl -sS https://getcomposer.org/installer | tee composer-setup.php \
    && php7 composer-setup.php && rm composer-setup.php* \
    && chmod +x composer.phar && mv composer.phar /usr/bin/composer \
    && ln -s /usr/bin/php7 /usr/local/bin/php

RUN apk add --update nodejs npm \
    && npm install --global yarn

COPY symfony.ini /etc/php7/conf.d/
COPY symfony.ini /etc/php7/cli/conf.d/

COPY symfony.pool.conf /etc/php7/php-fpm.d/

WORKDIR /var/www/symfony

CMD ["php-fpm7", "-F"]

EXPOSE 9001
