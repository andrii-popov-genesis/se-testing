FROM php:8.2.3-fpm-buster

ARG USER_ID
ARG GROUP_ID

WORKDIR /code

COPY --from=composer:2.2.5 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update -qq --fix-missing \
    && apt-get install -qq -y --no-install-recommends \
    bash \
    git \
    wget \
    curl \
    ca-certificates \
    tzdata \
    apt-transport-https \
    libxslt-dev \
    libxml2-dev \
    lsb-release \
    apt-utils \
    software-properties-common \
    xz-utils \
    libfontconfig1 \
    libxrender1 \
    libicu-dev \
    locales \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    opcache \
    calendar \
    zip \
    intl \
    exif \
    gettext \
    pcntl \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    xsl


COPY ./docker/php/configs/cli/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/configs/fpm/php.ini /usr/local/etc/php-fpm.d/php.ini

## create custom user for php-fpm service
#RUN if [ ${USER_ID} -ne 0 ] && [ ${GROUP_ID} -ne 0 ]; then \
#        bash -c 'if [ ${OSTYPE} == Darwin ]; then groupmod -g 81 "dialout"; fi' \
#        && groupadd -g ${GROUP_ID} ${USERNAME} \
#        && useradd -l -u ${USER_ID} -g ${GROUP_ID} -m ${USERNAME} \
#        && chown --changes --silent --no-dereference --recursive ${USER_ID}:${GROUP_ID} \
#            /run \
#            /var/log \
#            /usr/local/lib \
#            /usr/local/etc \
#            /usr/local/sbin/php-fpm \
#            /home/${USERNAME}/.composer \
#            /usr/local/bin/composer 2>&1 >/dev/null \
#    ;fi
STOPSIGNAL SIGTERM

EXPOSE 9000

CMD ["/usr/local/sbin/php-fpm","--nodaemonize", "-c", "/usr/local/etc/php-fpm.d/php.ini"]
