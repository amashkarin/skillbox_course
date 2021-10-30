FROM php:8.0.3-fpm-buster


RUN apt update && apt install -y git curl zip supervisor

RUN docker-php-ext-install pdo pdo_mysql

RUN set -x \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv composer.phar /usr/local/bin/composer


COPY ./supervisord.conf /etc/supervisor/supervisord.conf
COPY ./supervisor-laravel.conf /etc/supervisor/conf.d/laravel.conf


CMD supervisord --nodaemon
