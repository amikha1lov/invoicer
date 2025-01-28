FROM nginx:latest

COPY invoicer.local.conf /etc/nginx/conf.d/invoicer.local.conf

WORKDIR /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
