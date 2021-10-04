#!/usr/bin/make
SHELL = /bin/sh

ifndef NGINX_HOST_PORT
override NGINX_HOST_PORT = 80
endif

ifndef MYSQL_HOST_PORT
override MYSQL_HOST_PORT = 3306
endif

setup:
	rm -rf .env
	echo "NGINX_HOST_PORT=${NGINX_HOST_PORT}" >> .env
	echo "MYSQL_HOST_PORT=${MYSQL_HOST_PORT}" >> .env
	chmod 777 web/assets runtime
	docker-compose up -d --build
	docker run --rm --interactive --tty --volume $(PWD):/app -u $(shell id -u):$(shell id -g) composer:2 install --ignore-platform-reqs
	sleep 10s
	docker-compose run --rm --no-deps php-fpm php yii migrate/up --interactive=0
