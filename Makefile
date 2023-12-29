build: 
	docker-compose build
	docker-compose up -d

rebuild:
	docker-compose down
	make build

setup:
	docker exec app php artisan migrate
	docker exec app php artisan db:seed