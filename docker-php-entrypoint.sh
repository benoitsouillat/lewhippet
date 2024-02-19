#!/bin/bash

# Attend que MySQL soit prêt à accepter des connexions
until nc -z -v -w30 db 3306
do
  echo "En attente de la disponibilité de MySQL sur le port 3306..."
  sleep 10
done
  echo "Mysql démarré"

# Démarrer Apache
apache2-foreground &

# Sans la mention & le script s'arretera à apache2
# Attendre quelques secondes puis exécuter les scripts PHP après le démarrage d'Apache
sleep 5 
php /var/www/html/database/generator.php
php /var/www/html/database/make_data.php

# Garder le conteneur en vie
tail -f /dev/null