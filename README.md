# TUXPAN PRUEBA TÉCNICA
## SETUP
```shell
# copiar env file y escribir password a utilizar para user tuxpan
cp .env.example .env
# crear los contenedores y ejecutarlos
docker compose --env-file .env up -d
# ejecutar la shell de mysql
docker compose exec tuxpan-db sh
# crear base de datos, usuario y dar privilegios
mysql -u root -p 
create database tuxpan_crud;
create user 'tuxpan'@'%' identified by 'tuxpantest';
grant all privileges on tuxpan_crud.* to 'tuxpan'@'%';
flush privileges;
```
## DOCKER
* Se ha optado por utilizar
    * php:8.1-fpm para la app Laravel
    * nginx:alpine para el servidor
    * mysql:8.1 para la base de datos
### Detalle Dockerfile

