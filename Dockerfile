FROM php:5.6-apache

RUN docker-php-ext-install mysql mysqli



RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 
RUN apt-get update && apt-get install -y libpng-dev 
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-xpm-dir \
    --with-freetype-dir \
    --enable-gd-native-ttf



RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

RUN apt-get install -y \
        libfreetype6-dev \
        libmcrypt-dev \
        libjpeg-dev \
        libpng-dev
RUN docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-freetype-dir=/usr/include/freetype2 \
        --with-png-dir=/usr/include \
        --with-jpeg-dir=/usr/include \
    && docker-php-ext-install gd

COPY apache2.conf /etc/apache2
WORKDIR /var/www/html
COPY . /var/www/html/
COPY ./annotate.conf /etc/apache2/sites-available/
COPY ./hosts /etc/
RUN echo "127.0.0.1	annotate.co" >> /etc/hosts
#COPY start-apache /usr/local/bin
RUN a2enmod rewrite
EXPOSE 80
