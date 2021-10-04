Short link service
------------------
      api/                 contains api
      config/              contains application configurations
      controllers/         contains Web controller classes
      migrations/          contains db migration classes
      models/              contains model classes
      runtime/             contains files generated during runtime
      views/               contains view files for the Web application
      web/                 contains the entry script and Web resources

INSTALLATION
------------
### Docker
~~~
# apt-get update
# apt install -y docker docker-compose
~~~

### Makefile

~~~
$ make setup [NGINX_HOST_PORT=80]
~~~
To run a multiple docker on host use custom port

BASIC USAGES
------------
### http://127.0.0.1/api/v1/link/create POST
~~~
Header
"Content-Type": "application/x-www-form-urlencoded"

Data
url=http://github.com
~~~
### http://127.0.0.1/api/v1/{hash} GET
~~~
{
    "status":"ok",
    "url":"http://github.com",
    "click_count":2,
    "short_url":"http://127.0.0.1/751ba6d4"
}
~~~
### http://127.0.0.1/{hash} GET
~~~
increment click count
redirect to http://github.com
~~~