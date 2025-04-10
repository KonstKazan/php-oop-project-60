install:
	composer install

console:
	composer exec --verbose psysh

lint:
	composer exec --verbose phpcs -- src
	composer exec --verbose phpstan

lint-fix:
	composer exec --verbose phpcbf -- src

test:
	composer exec --verbose phpunit tests