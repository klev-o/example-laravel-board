up: docker-up
restart: docker-down docker-up

init: docker-clear docker-build docker-up

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

test:
	docker-compose exec php-cli vendor/bin/phpunit

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache
