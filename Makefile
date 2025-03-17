init:
	docker compose up -d

docker:
	docker compose exec -it php /bin/bash

rebuild:
	docker compose up -d --build

composer:
	docker compose exec -it php sh -c "composer install"

cs:
	docker compose exec -it php sh -c "composer run cs"

cs-fix:
	docker compose exec -it php sh -c "composer run cs-fix"

phpstan:
	docker compose exec -it php sh -c "composer run phpstan"

tests:
	docker compose exec -it php sh -c "composer run tests"