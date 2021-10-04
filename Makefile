#!/usr/bin/make
SHELL = /bin/sh

setup:
	chmod 777 web/assets runtime
	docker-compose up -d --build
	docker run --rm --interactive --tty --volume $(PWD):/app -u $(shell id -u):$(shell id -g) composer:2 install --ignore-platform-reqs
	docker-compose run --rm --no-deps php-fpm php yii migrate/up --interactive=0
