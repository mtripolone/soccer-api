up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

migrate:
	./vendor/bin/sail artisan migrate

seed:
	./vendor/bin/sail artisan db:seed

serve:
	./vendor/bin/sail artisan serve --host=0.0.0.0 --port=8000

install:
	./vendor/bin/sail composer install
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail artisan db:seed
	 