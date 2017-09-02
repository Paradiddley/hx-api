FROM ubuntu:latest

RUN apt-get update && apt-get install -y software-properties-common language-pack-en-base \
    && LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y git-all php7.0 php7.0-fpm php7.0-mysql mcrypt php7.0-gd curl \
       php7.0-curl php7.0-xml php-redis php7.0-mbstring php7.0-xdebug sendmail supervisor \
    && mkdir /run/php \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY fpm/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN echo "xdebug.idekey = PHPSTORM" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.default_enable = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_enable = 1" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_autostart = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_connect_back = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.profiler_enable = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
RUN echo "xdebug.remote_host = 10.254.254.254" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini

RUN sed -i -e 's/listen = \/run\/php\/php7.0-fpm.sock/listen = 0.0.0.0:9000/g' /etc/php/7.0/fpm/pool.d/www.conf \
    && sed -i -e 's/;daemonize = yes/daemonize = no/g' /etc/php/7.0/fpm/php-fpm.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD app /var/app
WORKDIR /var/app
RUN composer install

EXPOSE 9000

CMD ["/usr/bin/supervisord"]