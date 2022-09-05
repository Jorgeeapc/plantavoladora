### Aplicación web Planta Voladora

Sistema de catálogo, venta y solicitud de confección a medida para la tienda de ropa Plantavoladora que actualmente trabaja a través de Instagram. Todo el trabajo, desde la confección hasta la entrega de productos es realziado por solo una persona, la dueña, por lo que los procesos son poco eficientes y muchas veces hay confución con las entregas y el ,manejo de dinero. La aplicación busca entregar soporte y apoyo en la toma de decisiones y manejo de la información y dinero. 

## Software stack

El proyecto Planta Voladora es una aplicación que corre sobre el siguiente software:

- Ubuntu 20.04
- Apache 2.4.41 (Ubuntu)
- Php 7.4.3 (mysql-server,npm, git, curl, libxml2-dev, libonig-dev, libpng-dev, zip, unzip)
- Composer 2.4.1
- Framework Php Laravel 8.83
- NodeJS 10.19
- Mysql 8.0.30

## Configuraciones de ejecución para entorno de Desarrollo

Para obetener una copia del proyecto y ejecutarlo locamente se deben seguir los siguiente pasos

### Clonar repositorio

- Dirigirse a la ruta en la que se va a copiar el proyecto
- En una consola ingresar los siguientes comandos

```bash
git clone https://github.com/Jorgeeapc/plantavoladora.git
```

### Credenciales de base de datos y variables de entorno

- Editar el archivo /.env ingresando en las variables DB_USERNAME y DB_PASSWORD valores que luego serán usados al crear la base de datos

### Docker, Máquina virtual y sistema operativo

- En una terminal situarse en la carpeta raíz donde fue clonado este repositorio. 
- Una vez situado en la raíz del proyecto, dirigirse al directorio Docker y ejecutar lo siguiente para construir la imagen docker.

```bash
docker build -t nombredelaimagen .
```
- Construir el contenedor

```bash
docker run -ti -d -p 80:80 --name nombredelcontenedor -v "PATH del proyecto:/var/www/html/plantavoladora" nombredelaimagen
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
nano /etc/apache2/sites-available/000-default.conf
```
- Una vez abierto el archivo agregar las siguiente líneas dentro de los componentes <VirtualHost>

<Directory /PATH>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

- Activar rewrite de apache2 y recargar servicio 

- En caso de cerrarse la bash de este contenedor al reiniciar apache se deben ejecutar los siguientes comandos

```bash
docker start nombredelcontenedor
winpty docker exec -ti nombredelcontenedor bash
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

Se debe ingresar credenciales en los espacios 'usuario' y 'contraseña', deben ser iguales a las antes ingresadas en el archi .env

```bash
CREATE DATABASE plantavoladora;
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT ALL PRIVILEGES ON * . * TO 'usuario'@'localhost';
FLUSH PRIVILEGES;
exit
```

- Instalar dependencias del fichero composer.json

```bash
composer update
```

- Poblar base de datos

```bash
cd /var/www/html/plantavoladora
php artisan migrate --seed
```

## Configuraciones de ejecución para entorno de Producción

- Dentro de la consola dirigirse al directorion /var/www/html y clonar este repositorio
- Ingresar a la carpeta creada 'plantavoladora'
- Instalar dependencias del proyecto con Composer

```bash
composer update
```
- Otorgar permisos a directorio bootstap y storage

```bash
sudo chmod -R ugo+rw storage
sudo chmod -R 777 bootstrap
```
- Desde este punto es necesario ingresar como super user

- Editar archivo /.env ingresando en las variables siguientes, los valores entregados como credenciales
    DB_HOST=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

- Configurar archivo 000-default.conf

```bash
nano /etc/apache2/sites-available/000-default.conf
```
- Una vez abierto el archivo agregar las siguiente líneas dentro de los componentes <VirtualHost>

<Directory /var/www/html/plantavoladora>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

- Activar rewrite de apache2 y recargar servicio 

- Correr migraciones

## Contruido con

- Laravel
- Livewire
- Jetstram
- Tailwind

## Licencia

## Contribuir al proyecto

- Por favor lea las instrucciones para contribuir al proyecto en [CONTRIBUTING.md]

## Agradecimientos

- Tienda Planta Voladora
- Universidad del Bio Bio
- Docentes guía Alejandra Segura y Juan Pablo Soto por el soporte y guía en el desarrollo de este proyecto








