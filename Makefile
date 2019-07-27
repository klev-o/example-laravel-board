docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker exec app_php-cli_1 vendor/bin/phpunit

perm:
	sudo chmod 777 -R storage

assets-install:
	docker exec app_node_1 npm install

assets-rebuild:
	docker exec app_node_1 npm rebuild node-sass --force

assets-dev:
	docker exec app_node_1 npm run dev

assets-watch:
	docker exec app_node_1 npm run watch
