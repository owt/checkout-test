FROM php:8.2-cli
COPY ./src /app/src
COPY ./composer.json /app
COPY ./composer.lock /app
COPY ./phpunit.xml /app
COPY ./test.sh /app 
COPY ./app.sh /app
WORKDIR /app
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction 
RUN composer dump
ENTRYPOINT ["tail", "-f", "/dev/null"]
