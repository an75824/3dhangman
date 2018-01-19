FROM php:7.2.1-apache-stretch

WORKDIR .

ADD . /var/www/html/3dhangman

RUN chown -R www-data /var/www/html/3dhangman/score

COPY apache2.conf /etc/apache2/

RUN mkdir /var/ci_sessions

RUN chown -R www-data /var/ci_sessions

RUN a2enmod rewrite

RUN echo "define('DOCKER_PORT','1908');" >> /var/www/html/3dhangman/application/config/constants.php

RUN echo "define('SESS_TEMP_DIR','/var/ci_sessions');" >> /var/www/html/3dhangman/application/config/constants.php

EXPOSE 80

