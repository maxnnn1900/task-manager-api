help:
	@cat Makefile

build:
	docker-compose build \
		--build-arg USER_ID=$$(id -u) \
		--build-arg GROUP_ID=$$(id -g)

up:
	docker-compose up -d

down:
	docker-compose down

bash:
	docker-compose exec app bash

restart: down up

migrate:
	docker-compose exec app php artisan migrate

seed:
	docker-compose exec app php artisan db:seed

refresh:
	docker-compose exec app php artisan migrate:fresh --seed

logs:
	docker-compose logs -f

composer:
	docker-compose exec app composer install
