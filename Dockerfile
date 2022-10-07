FROM php:7.4.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev
RUN apt-get install git -y \
        zip \
	libzip-dev \
  && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.4.1
RUN curl http://host.docker.internal:5432
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

WORKDIR /app
COPY . /app

RUN composer update

#EXPOSE 8000
#CMD php artisan serve --host=0.0.0.0 --port=8000