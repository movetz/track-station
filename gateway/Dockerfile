FROM nginx:1.10

ADD ./locations /etc/nginx/locations
ADD ./vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www