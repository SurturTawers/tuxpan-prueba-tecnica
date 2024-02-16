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
# migrar y rellenar base de datos
docker compose exec tuxpan-app sh
php artisan migrate:fresh && php artisan db:seed
```
## DOCKER
* Se ha optado por utilizar
    * php:8.1-fpm para la app Laravel
    * nginx:alpine para el servidor
    * mysql:8.1 para la base de datos

### Detalle Dockerfile

* Es una implementación simple en la que se usa php8.1-fpm para ejecutar la aplicación
* se instalan las dependencias necesarias que serían mysqli, pdo y pdo_mysql para el correcto funcionamiento de la conexion con la base de datos
* Luego se modifica el ownership de los directorio storage y bootstrap/cache de laravel para que el contenedor pueda escribir en ellos
* Finalmente, exponiendo el puerto 9000 para que el servidor nginx redireccion las peticiones http al contenedor de php

## Implementación
* URL: http://localhost/api

| Ruta                | Metodo      |
|---------------------|-------------|
| tasks/              | GET, POST   |
| tasks/{task_id}     | PUT, DELETE |
| user/login          | POST        |
| user/register       | POST        |
| user/task/{task_id} | POST        |

### Tareas (Tasks)
* Se ha implementado el CRUD de tareas de la siguiente forma
  * Se obtienen las tareas para cualquier usuario registrado en el sistema y obtiene los usuarios asignados a esa tarea
  * Se crea una nueva tarea con la asignacion opcional de usuarios, solo admins pueden realizar esta accion
  * Se actualizan los datos de una tarea por id, solo para admins
  * Se elimina una tarea y la asignación de usuarios, solo para admins
* En cuanto a autenticación se ha utilizado Sanctum para validar los JWT y obtener a que usuario le corresponde
* De esta forma podemos autorizar a los usuarios dependiendo de su rol en el sistema

* Para los modelos se ha establecido la relación Many to Many entre usuarios y tareas
* Implementando los metodos users() y tasks() para poder obtener los elementos relacionados con Query Builder

### Usuarios (Users)
* Los usuarios se pueden registrar y autenticar obteniendo un JWT para poder autenticarse en las peticiones
* De esta forma nos aseguramos de que solo sea accesible para usuarios autorizados
### Validaciones
* Para validar las peticiones entrantes se ha hecho uso de Request personalizadas que con sus reglas de validación permiten crear una primera capa de protección de la integridad de los datos
