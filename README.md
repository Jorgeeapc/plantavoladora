### Aplicación web Planta Voladora

Sistema de catálogo, venta y solicitud de confección a medida para la tienda de ropa Plantavoladora que actualmente trabaja a través de Instagram. Todo el trabajo, desde la confección hasta la entrega de productos es realziado por solo una persona, la dueña, por lo que los procesos son poco eficientes y muchas veces hay confución con las entregas y el ,manejo de dinero. La aplicación busca entregar soporte y apoyo en la toma de decisiones y manejo de la información y dinero. 

## Software stack

El proyecto Planta Voladora es una aplicación que corre sobre el siguiente software:

- Ubuntu 20.04
- Apache
- Php 7.4 (apache2, mysql-server,npm, git, curl, libxml2-dev, libonig-dev, libpng-dev, zip, unzip)
- Composer
- Framework Php Laravel 8.83
- NodeJS
- Base de datos Mysql

## Configuraciones de ejecución para entorno de Desarrollo/Producción

Para obetener una copia del proyecto y ejecutarlo locamente se deben seguir los siguiente pasos

### Credenciales de base de datos y variables de entorno

- Editar el archivo /.env ingresando las credenciales correspondientes en las variables DB_USERNAME y DB_PASSWORD (la variables se crean junto a la BD)

### Docker, Máquina virtual y sistema operativo

- En una terminal situarse en la carpeta raíz donde fue clonado este repositorio. 
- Una vez situado en la raíz del proyecto, dirigirse al directorio Docker y ejecutar lo siguiente para construir la imagen docker.

```bash
docker build -t nombredelaimagen .
```
- Construir el contenedor

```bash
docker run -ti -d -p 80:80 --name nombredelcontenedor -v "c:\ruta del proyecto:/var/www/html/plantavoladora" nombredelaimagen
```

### Instalar dependencias del proyecto e iniciar servicios

Para instalar las dependencias se debe ejecutar una bash desde el contenedor con los siguiente comandos

```bash
docker exec -ti nombredelcontenedor bash
```
o en su defecto

```bash
winpty docker exec -ti nombredelcontenedor bash
```
Una vez dentro del contenedor (en la bash)

###
 - Configurar archivo 000-default.conf

```bash
apt install nano
nano /etc/apache2/sites-available/000-default.conf
```
- Una vez abierto el archivo agregar las siguiente líneas dentro de los componentes <VirtualHost>

<Directory /var/www/html/plantavoladora>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

- Guardar los cambios con ctrl+o y ctrl+c para salir

- Activar rewrite de apache2 y recargar servicio 

```bash
a2enmod rewrite
service apache2 restart
```

-Iniciar servicio mysql

```bash
service mysql start
```
- Ingresar a consola mysql

```bash
mysql
```
- Crear base de datos

Se debe ingresar credenciales en los espacios 'usuario' y 'contraseña'

```bash
CREATE DATABASE plantavoladora;
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON * . * TO 'usuario'@'localhost';
FLUSH PRIVILEGES;
exit
```
- Poblar base de datos

```bash
cd /var/www/html/plantavoladora
php artisan migrate --seed
```

## Contruido con

- Laravel

## Licencia

## Contribuir al proyecto

- Por favor lea las instrucciones para contribuir al proyecto en [CONTRIBUTING.md]

## Agradecimientos

- Tienda Planta Voladora
- Universidad del Bio Bio
- Docentes guía Alejandra Segura y Juan Pablo Soto por el soporte y guía en el desarrollo de este proyecto








