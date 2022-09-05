# **Sistema de Inventario de la Clinica de Veterinaria**

Este Sistema está diseñado para controlar y gestionar el inventario de la Clinica Veterianaria. 

## **Clonar sistema en Modo Desarrollo**
Para este apartado se necesitará que se tenga instalado: 

- [PHP (Hypertext Preprocessor)](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)  
- [Git](https://git-scm.com/downloads)

Una vez instalado lo anterior mencionado, se procede a clonar el repositorio de GitLab.

- Clonar con SSH:
    <code>

        git clone gt@gitlab.com:utmdag7/inventario_vet_utm.git 

    </code>
  

- Clonar con HTTS:
    <code>

         git clone ttps://gitlab.com/utmdag7/inventario_vet_utm.git

    </code> 

Se procede a entrar en la carpeta del repositorio clonado y en la consola se coloca el siguiente comando: 
<code>

    compser install 

</code>

Se hacen las mgraciones correspondientes para la base de datos:
<code>

    php artisa migrate 

</code>

Se actualizan os seed de la base de datos:
<code>

    php artisa db:seed 

</code>

Luego de esto a puede ejecutar la aplicación web en modo desarrollo con el siguiente comando: 
 <code>

    php artisa serve 

</code>


## **Clonar sistema en Modo Producción**

Para este caso se debe tener en cuenta el tipo de distribución Linux en la qe esté corriendo vuestro servidor: 

Para ello, es necesario intalar: 

- PHP - last version
- Composer
- Git
- npm (Node Package Manager) 

Dentro del seridor, deben posicionarse en la ruta
<code>

    cd /var/www 

</code>

En la carpeta e debe clonar el repositorio de GitLab
<code>

    git clone htps://gitlab.com/utmdag7/inventario_vet_utm.git

</code>


Luego de esto se ingresa al directorio del proyecto, para este caso: 
<code>

    cd invntaio_vet_utm 

</code>


Ahora se procede a instalar las dependencias necesarias para ejecutar el aplicativo:
<code>

    composer install
    npm install

</code>


Es necesario, además, un archivo de configuración para las variables de entorno, el cual se debe crear con el comando touch: 
<code>

    touch .env
</code>

En el archivo .env colocar el siguiente código: 
<code> 
        
        APP_NAME=
        APP_ENV=production
        APP_KEY=base64:7mOB49JobliFt9alcq1ljqjqGokuAlncs9/4irVDvZI=
        APP_DEBUG=false
        APP_URL=<url page>

        LOG_CHANNEL=stack
        LOG_DEPRECATIONS_CHANNEL=null
        LOG_LEVEL=debug

        DB_CONNECTION=psql
        DB_HOST= host de la base de datos
        DB_PORT= puerto de la base de datos
        DB_DATABASE= nombre de la base de datos
        DB_USERNAME= usuario
        DB_PASSWORD= contraseña

        BROADCAST_DRIVER=log
        CACHE_DRIVER=file
        FILESYSTEM_DISK=local
        QUEUE_CONNECTION=sync
        SESSION_DRIVER=database
        SESSION_LIFETIME=120 

        MAIL_MAILER=smtp
        MAIL_HOST=smtp.googlemail.com
        MAIL_PORT=465
        MAIL_USERNAME= correo
        MAIL_PASSWORD= contraseña
        MAIL_ENCRYPTION=ssl
        MAIL_FROM_ADDRESS= correo
        MAIL_FROM_NAME="${APP_NAME}"

        MEMCACHED_HOST=127.0.0.1

        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379

        AWS_ACCESS_KEY_ID=
        AWS_SECRET_ACCESS_KEY=
        AWS_DEFAULT_REGION=us-east-1
        AWS_BUCKET=
        AWS_USE_PATH_STYLE_ENDPOINT=false

        PUSHER_APP_ID=
        PUSHER_APP_KEY=
        PUSHER_APP_SECRET=
        PUSHER_APP_CLUSTER=mt1

        VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
        VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
</code>

En el archivo .env debe actualizar los parámetros de configuración para la conexión con la base de datos.

Se hacen las mgraciones correspondientes para la base de datos:
<code>

    php artisa migrate 

</code>

Se actualizan os seed de la base de datos:
<code>

    php artisa db:seed 

</code>

luego de esto a puede ejecutar la aplicación web con el siguiente comando: 
 <code>

    php artisa serve 

</code>