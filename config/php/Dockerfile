FROM php:8.0-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    apt-utils \
    libpq-dev \
    zip unzip \
    build-essential \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    nano \
    cron \
    libonig-dev \
    git && \
    docker-php-ext-install pdo_mysql && \
          docker-php-ext-install bcmath && \
          docker-php-ext-install gd && \
          docker-php-ext-install zip && \
          apt-get clean && \
          rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

COPY ./start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

# Cron config
COPY ./app.crontab /etc/cron.d/app.crontab
RUN chown www:www /etc/cron.d/app.crontab

RUN touch /var/log/cron.log
RUN chmod ugo+rwx /var/log/cron.log

RUN chmod gu+rw /var/run
RUN chmod gu+s /usr/sbin/cron

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["/usr/local/bin/start"]
