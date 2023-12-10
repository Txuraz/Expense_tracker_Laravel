FROM php:latest

WORKDIR /app

COPY . /app

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

ENV APP_ENV=local
ENV APP_KEY=base64:SwkOIKKdaalZZLhY7BhY9d46DUp/+hBQ2h4mfvpdvaA=

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
