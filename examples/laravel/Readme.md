# Reference

## Swoole

**Reference**: https://github.com/swooletw/laravel-swoole/wiki

### Step 1:

Install Swoole in your environment

### Step 2:

Once Swoole is installed, run:

```
php artisan swoole:http {start|stop|restart|reload|infos}
``` 

**Obs.**: nginx in the Docker container not being used in favor of **Swoole**. The nginx configuration is not present in the docker-compose.yml, but it remains here:

https://www.masterzendframework.com/docker-development-environment/

# docker-compose.yml (might not be necessary anymore)
```sh
version: '2'

volumes:
    database_data:
        driver: local

services:
  nginx:
      image: nginx:latest
      ports:
          - 8080:80
      volumes:
          - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
      volumes_from:
          - php
  php:
      build: ./docker/php/
      expose:
          - 9000
      volumes:
          - .:/var/www/html
  mysql:
      image: mysql:latest
      expose:
          - 3306
      volumes:
          - database_data:/var/lib/mysql
      environment:
          MYSQL_ROOT_PASSWORD: secret
          MYSQL_DATABASE: project
          MYSQL_USER: project
          MYSQL_PASSWORD: project
```

# docker repository
https://github.com/settermjd/docker-for-local-development.git

# command to start
```sh
docker-compose up -d
```

# command to stop

```sh
docker-compose stop
```



