FROM nginx:latest

COPY invoicer.amikha1lov.conf /etc/nginx/conf.d/invoicer.amikha1lov.conf

WORKDIR /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
