cd docker 
docker compose build
docker compose up -d

docker compose exec php-fpm bash

composer install
php bin/phpunit


----

мутаційне тестування https://infection.github.io/guide/
тестування в Symfony https://symfony.com/doc/current/testing.html

