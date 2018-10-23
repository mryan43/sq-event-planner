FROM docker.bank.swissquote.ch/composer:1.7.1 as composer

FROM docker.bank.swissquote.ch/php:7.2.9-apache

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer /usr/bin/composer /usr/bin/composer

ARG PHP_TIMEZONE="Europe/Zurich"
ARG PHP_INI_DIR="/usr/local/etc/php"

RUN echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "date.timezone=${PHP_TIMEZONE:-UTC}" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Install dependencies
RUN apt-get update -y
RUN apt-get install -y rsync                                      # Utilities
RUN apt-get install -y libcurl3 libcurl3-dev                      # curl
RUN apt-get install -y mcrypt libmcrypt-dev                       # mcrypt
RUN apt-get install -y libxml2 libxml2-dev libxslt1.1 libxslt-dev # xsl
RUN apt-get install -y libldap-common libldap2-dev                               # ldap
RUN apt-get install -y libedit2 libedit-dev                       # readline
RUN apt-get install -y zlib1g-dev                                 # zlib
RUN apt-get install -y libbz2-dev libbz2-1.0                      # bzip2

# Install PHP Extensions
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu
RUN docker-php-ext-install curl bcmath pdo pdo_mysql xsl readline zip bz2 opcache ldap pcntl mbstring

ENV APACHE_DOCUMENT_ROOT /app/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

COPY docker/php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite

WORKDIR /app

COPY app /app/app
COPY bootstrap /app/bootstrap
COPY config /app/config
COPY database /app/database
COPY public /app/public
COPY resources /app/resources
COPY routes /app/routes
# /app/storage is expected to be mounted as a volume
COPY artisan /app/artisan
COPY composer.json /app/composer.json
COPY composer.lock /app/composer.lock

RUN ls -alh /app/database

RUN composer install --no-dev --optimize-autoloader

# Commented out because some of our configuration is not serializable
#RUN /app/artisan config:cache
#RUN /app/artisan route:cache

# Do not run as root by default
USER www-data
