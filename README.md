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
### Docker, git
~~~
# apt-get update
# apt install -y docker docker-compose git
~~~

### Makefile

~~~
$ make setup 
~~~