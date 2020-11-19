FROM php:7.0-apache
MAINTAINER feng<@>

ENV path_w /var/www/html
COPY . $path_w
WORKDIR $path_w

RUN mv config.ini /
RUN echo "ServerName  172.17.0.2" >> /etc/apache2/sites-enabled/000-default.conf
RUN chmod -R 775 .
RUN chmod 775 /config.ini

EXPOSE 8888:80
ONBUILD "HELLO"
ENTRYPOINT service apache2 start && tail -F /var/log/apache2/error.log