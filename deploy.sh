#!/bin/bash

echo "*** DEPLOY IS STARTED ***"
cp ./.env-example ./.env
cp ./.env-example ./laravel/.env

echo "** RUN DOCKER COMPOSE **"
docker-compose down
docker-compose up -d

echo "*** INSTALL COMPOSERS ***"
docker exec project_app composer install

echo "*** MIGRATE DATABASE  ***"
docker exec project_app php artisan migrate

echo "***** SET SYMBOLINK  ****"
docker exec project_app php artisan storage:link

echo "*** GIVE PERMISSIONS ****"
docker exec project_app chgrp -R www-data storage bootstrap/cache
docker exec project_app chmod -R ug+rwx storage bootstrap/cache

echo "** DEPLOY IS FINISHED **"