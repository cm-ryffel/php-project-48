.PHONY: install
install:
	composer install

.PHONY: lint
lint:
	./vendor/bin/phpcs --standard=PSR12 src bin tests

.PHONY: test
test:
	XDEBUG_MODE=off ./vendor/bin/phpunit tests

.PHONY: test-coverage
test-coverage:
	XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-clover=coverage.xml tests