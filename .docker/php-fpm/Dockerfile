FROM php:7.2-fpm

MAINTAINER Julien Guittard <julien.guittard@me.com>

ENV COMPOSER_ALLOW_SUPERUSER=1

ENV buildDeps \
            gnupg2 \
            libbz2-dev \
            libmemcached-dev \
            libnghttp2-dev
ENV runtimeDeps \
            cmake \
            curl \
            git \
            inotify-tools \
            libpq-dev \
            libfreetype6-dev \
            libhiredis-dev \
            libicu-dev \
            libjpeg62-turbo-dev \
            libmemcachedutil2 \
            libpcre3 \
            libpcre3-dev \
            libpng-dev \
            libpq-dev \
            libssl-dev \
            libxml2-dev \
            libzip-dev \
            locales \
            openssl \
            libpq-dev \
            unzip \
            vim \
            wget \
            zip \
            zlib1g-dev

RUN mkdir -p /usr/local/bin

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y $buildDeps $runtimeDeps --no-install-recommends

RUN set -xe \
    && docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure pdo_pgsql \
    && docker-php-ext-configure soap --enable-soap \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        bz2 \
        calendar \
        gd \
        gettext \
        iconv \
        intl \
        opcache \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        soap \
        sockets

RUN pecl install xdebug-2.6.0 apcu \
    && apt-get install -y gdb \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /tmp/* \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -r /var/lib/apt/lists/*

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

ADD config/pool.conf /usr/local/etc/php-fpm.d/

RUN usermod -u 1000 www-data

COPY config/php7.ini $PHP_INI_DIR/conf.d/
COPY config/php-fpm.ini $PHP_INI_DIR/php.ini
COPY config/xdebug.ini $PHP_INI_DIR/conf.d/

EXPOSE 9000

COPY entrypoint.sh /opt/entrypoint.sh
RUN chmod a+x /opt/entrypoint.sh

ENTRYPOINT ["/opt/entrypoint.sh"]

WORKDIR /var/www

CMD ["php-fpm"]