up: docker-up
restart: docker-down docker-up

init: docker-down-clear docker-pull docker-build docker-up app-init

docker-clear:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-up: memory
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-build: memory
	docker-compose build

docker-pull:
	docker-compose pull

app-init: app-composer-install app-wait-db app-migrations app-fixtures

app-composer-install:
	docker-compose run --rm php-cli composer install

app-wait-db :
	while docker-compose exec -T mysql ping -h"localhost" --silent ; do sleep 1 ; done

app-migrations:
	docker-compose run --rm php-cli php artisan migrate

app-fixtures:
	docker-compose run --rm php-cli php artisan db:seed

test:
	docker-compose exec php-cli vendor/bin/phpunit

assets-install:
	docker-compose exec node npm install

assets-rebuild:
	docker-compose exec node npm rebuild node-sass --force

assets-dev:
	docker-compose run --rm node yarn run dev

assets-watch:
	docker-compose exec node yarn run watch

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
