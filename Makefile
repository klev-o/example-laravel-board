up: docker-up
restart: docker-down docker-up

init: docker-clear docker-build docker-up app-init

docker-clear:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-build:
	docker-compose build

app-init: app-composer-install app-migrations app-fixtures

app-composer-install:
	docker-compose run --rm php-cli composer install

app-wait-db :
	until docker-compose exec -T manager-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

app-migrations:
	docker-compose run --rm php-cli php artisan migrate

app-fixtures:
	docker-compose run --rm php-cli php artisan db:seed

test:
	docker-compose exec php-cli vendor/bin/phpunit

assets-install:
	docker-compose exec node yarn install

assets-rebuild:
	docker-compose exec node npm rebuild node-sass --force

assets-dev:
	docker-compose run --rm node yarn run dev

assets-watch:
	docker-compose exec node yarn run watch

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
