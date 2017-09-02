FROM nginx

ADD nginx/default.conf /etc/nginx/conf.d/

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

ADD app /var/app

CMD service nginx start