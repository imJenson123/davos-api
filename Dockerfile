FROM php:7.4.1-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev
RUN apt-get install git -y \
        zip \
	libzip-dev \
  && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

WORKDIR /app
COPY . /app

RUN composer update

#EXPOSE 8000
#CMD php artisan serve --host=0.0.0.0 --port=8000