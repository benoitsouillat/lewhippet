# Utilisez l'image officielle PHP comme base
FROM php:8.2-apache

# Installation d'Apache et des dépendances
RUN apt-get update && apt-get install -y \
    apache2 \
    libgd-dev \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    netcat-traditional \
    && rm -rf /var/lib/apt/lists/*

# Installez les extensions PHP nécessaires pour votre application
RUN docker-php-ext-install mysqli pdo pdo_mysql gd fileinfo

# Activation de l'extension GD
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \ 
    --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd

# Configuration d'Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV SERVER_NAME 'damoiseaux'

# Exposez le port 80 pour le serveur web Apache
EXPOSE 80

# Copiez les fichiers de votre application dans le conteneur
COPY . ${APACHE_DOCUMENT_ROOT}
RUN chmod +rwx -R /var/www/html

# Copiez le script d'attente MySQL
COPY ./docker-php-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-php-entrypoint.sh

# Modification de les valeurs des variables directement dans php.ini -- upload_limit permet d'envoyer les grosses images et qu'elles soient traités par php
RUN echo "post_max_size = 64M" >> /usr/local/etc/php/php.ini && \
    echo "max_input_time = 60" >> /usr/local/etc/php/php.ini && \
    echo "apache_keep_alive_timeout = 30" >> /usr/local/etc/php/php.ini && \
    echo "apache_max_keep_alive_requests = 120" >> /usr/local/etc/php/php.ini && \
    echo "memory_limit = 1024M" >> /usr/local/etc/php/php.ini && \
    echo "max_execution_time = 60" >> /usr/local/etc/php/php.ini && \
    echo "upload_max_filesize = 64M" >> /usr/local/etc/php/php.ini && \
    echo "upload_limit = 64M" >> /usr/local/etc/php/php.ini

# Commande par défaut pour démarrer le serveur web Apache
CMD ["/usr/local/bin/docker-php-entrypoint.sh"]