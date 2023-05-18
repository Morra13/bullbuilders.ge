FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libnss3 \
    libatk1.0-0 \
    libcups2 \
    libdrm2 \
    libxkbcommon0 \
    libxcomposite1 \
    libxdamage1 \
    libxrandr2 \
    libgbm1 \
    libpango1.0.0 \
    libcairo2 \
    libasound2 \
    libxfixes3 \
    libatk-bridge2.0.0 \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    nano \
    procps


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash
RUN apt-get install -yq nodejs build-essential

RUN docker-php-ext-install sockets exif

RUN npm install -g npm

RUN npm install -g puppeteer ionic --loglevel verbose

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

#npm install -g puppeteer ionic --loglevel verbose
#npm install -g chromium ionic --loglevel verbose
#docker-compose run --rm pdf bash