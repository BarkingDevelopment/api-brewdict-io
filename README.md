## Notes for automation

1. Create .env with production keys.
	1. Change db address to db rather than url.
1. mkdir ./vendor
1. chmod -R 775 ./*
1. chown -R brewdict:1000 ./*
1. docker-compose exec appcomposer install
1. docker-compose exec app php artisan key:generate
1. docker-compose exec app php artisan migrate
1. Navigate to brewdict.io:8000
