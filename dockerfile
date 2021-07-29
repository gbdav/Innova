FROM php:7.3-apache
COPY . /var/www/html
WORKDIR \InnovaNotes
EXPOSE 80
CMD [ "php", "./index.php" ]



