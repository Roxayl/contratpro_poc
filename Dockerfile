FROM webdevops/php-nginx:7.4

ENV WEB_DOCUMENT_ROOT /var/www/html/public

COPY . /var/www/html/

RUN chown -R application:application /var/www/html

#RUN chmod -R 777 /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

CMD cd /var/www/html && composer install && php artisan key:generate

