FROM php:7.2.1-apache-stretch

WORKDIR .

ADD . /var/www/html/3dhangman

RUN chown -R www-data /var/www/html/3dhangman/score

COPY apache2.conf /etc/apache2/

RUN mkdir /var/ci_sessions

RUN chown -R www-data /var/ci_sessions

RUN a2enmod rewrite

EXPOSE 80

