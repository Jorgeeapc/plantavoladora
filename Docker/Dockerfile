FROM ubuntu:focal

ENV TZ=America/Santiago
RUN ln -sfn /usr/share/zoneinfo/$TZ /etc/localtime &&echo $TZ > /etc/timezone

# Añadimos dependencias y utilidades interesantes al sistema como: git, curl, zip, ...:
RUN apt-get update && apt-get install -y php7.4 php7.4-mysql php7.4-curl php-xml apache2 mysql-server nodejs npm nano
    
RUN apt-get update && apt-get install -y git

RUN apt-get update && apt-get install -y libxml2-dev libonig-dev libpng-dev zip unzip

# Una vez finalizado borramos cache y limpiamos los archivos de instalación
RUN apt-get clean /var/lib/apt/lists/*


# Instalamos dentro de la imagen la última versión de composer, para ello copiamos la imagen disponible en el repositorio:
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos de la última imagen de node en nuestro proyecto las librerías de los módulos y de node
COPY --from=node:latest /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:latest /usr/local/bin/node /usr/local/bin/node

RUN composer require livewire/livewire

RUN service mysql start

ENTRYPOINT ["usr/sbin/apache2ctl"]
CMD ["-D","FOREGROUND"]
