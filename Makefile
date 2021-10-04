#!/usr/bin/make
SHELL = /bin/sh

ifndef NGINX_HOST_PORT
override NGINX_HOST_PORT = 80
endif

setup:
	rm -rf .env
	echo "NGINX_HOST_PORT=${NGINX_HOST_PORT}" >> .env
	docker-compose up -d --build
	docker run --rm --interactive --tty --volume $(PWD):/app -u $(shell id -u):$(shell id -g) composer:2 install --ignore-platform-reqs
	docker-compose exec php-fpm php yii migrate/up --interactive=0
	chmod 777 web/assets runtime
