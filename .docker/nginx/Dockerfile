FROM nginx:latest

MAINTAINER Julien Guittard <julien.guittard@me.com>

COPY config/nginx.conf /etc/nginx/
COPY config/fastcgi.conf /etc/nginx/
COPY config/test.foodmeup.local.conf /etc/nginx/sites-available/
COPY config/upstream.conf /etc/nginx/conf.d/

RUN usermod -u 1000 www-data

CMD ["nginx"]