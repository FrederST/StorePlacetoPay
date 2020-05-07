<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

### Para tu comodidad este proyecto se encuantra funcionando en el siguiente enlace.

__-[Store-PlacetoPay](http://placetopay-store.herokuapp.com/)__

# Descripción.
Esta es una tienda basica la cual integra el sitemas de pagos de PlacetoPay, Web Checkout, basicamente se busca cumplir con los siguiente requerimientos.

La tienda debe contener las siguientes vistas
1. Una donde el cliente proporcione los datos necesarios para generar una nueva orden.
2. Una donde se presente un resumen de la orden y se permita proceder a pagar.
3. Una donde el cliente pueda ver el estado de su orden, si está pagada muestre el mensaje de que está pagada, de lo contrario, un botón que permita reintentarlo debe estar presente.
4. Una donde se pueda ver el listado de todas las órdenes que tiene la tienda.


# Instalación.

1. Para un apropiado funcionamiento y no tener problemas durante la instalacion primero debemos habilitar la extensión SOAP en nuesto archivo __'php.ini'__ ubicado en __'C:\xampp\php'__.

![env-imagen](https://i.ibb.co/v1cz5nD/Screenshot-19.png)
![env-imagen](https://i.ibb.co/7b61rnY/Screenshot-20.png)

__NOTA: Recuerda reiniciar el servidor si lo tienes activo.__

2. Creamos una nueva base de datos donde se ejecutara nuestro proyecto.
![env-imagen](https://i.ibb.co/L6Cp7Ch/Screenshot-22.png)

3. Renombramos el archivo __.env.example__ pro __.env__, en este configuraremos nuestra base de datos.
![env-imagen](https://i.ibb.co/8dQXLVL/Screenshot-1.png)

4. Tambien podemos Modificar nuestro LOGIN y TRANKEY en el archivo __env.__ (Estos datos nos permitiran autenticarnos en el servicio de PlacetoPay, ya vienen incluido los de prueba asi que lo recomendable es no modificarlos.
![env-imagen](https://i.ibb.co/D8QbLXh/Screenshot-2.png)

5. Ejecutamos el comando __composer update__, para actualizar las dependencias.

6. Ejecutamos el comando __php artisan key:generate__, para poder ejecutar nuestra aplicación.

## Base Datos.

Debemos agregar las tablas y datos necesarios para el funcionamiento de nuestra aplicación aquí usaremos __migrate y seeder__ de laravel :

1. Ejcutamos en comando __php artisan migrate__, este nos creara las tablas necesarias.

2. Ejecutamos el comando __php artisan db:seed__, para agregar los datos necesarios en nuestras tablas.

# Ejecucion.

Ya instalada nuestra aplicaión la ejecutamos con el comando __php artisan serve__.

Si todo se encuatr bien nuestra aplicación deberia ejecutarse en la ruta mostrada en consola.
 ![artisan serve](https://i.ibb.co/3h2Q5d8/Screenshot-3.png)

 # Vistas.

 1. Una donde el cliente proporcione los datos necesarios para generar una nueva orden.
 
    A esta podemos acceder en la parte superior de nuestra aplicación.
     ![register 1](https://i.ibb.co/fMMSrNt/Screenshot-23.png)
     ![register 2](https://i.ibb.co/YL9YNz1/Screenshot-5.png)
    Si deseas puedes registrarte con tus datos para probar el sistema, de lo contrario puedes usar las siguientes credenciales:
    - Email: rimubiddik-5999@yopmail.com
    - Password: laravel

2. Una donde se presente un resumen de la orden y se permita proceder a pagar.

    Para poder acceder a esta vista debemos proceder a la compra de un producto y estar logueados en el sistema.
    ![orders 1](https://i.ibb.co/JW19WFF/Screenshot-24.png)
    ![orders 3](https://i.ibb.co/jgHGf7d/Screenshot-8.png)
    ![orders 4](https://i.ibb.co/mJsLrYG/Screenshot-25.png)

3. Una donde el cliente pueda ver el estado de su orden, si está pagada muestre el mensaje de que está pagada, de lo contrario, un botón que permita reintentarlo debe estar presente.

    Para acceder a esta vista tambien se debe estar logueado en el sistema, podemos obtener la información en 2 apartados de la aplicaión.

    1. En el __home__ de nuestra aplicación.

    ![UserOrders 1](https://i.ibb.co/YLXz3Yj/Screenshot-26.png)
    ![UserOrders 2](https://i.ibb.co/YNsfY7K/Screenshot-13.png)
    

    2. Al finalizar la compra en la plataforma de PlacetoPay.
    
    ![UserOrders 3](https://i.ibb.co/syrjm1w/Screenshot-10.png)
    ![UserOrders 4](https://i.ibb.co/JdTYqTg/Screenshot-11.png)


4. Una donde se pueda ver el listado de todas las órdenes que tiene la tienda.

    Para acceder a esta no es necesario estar logueado en el sistema podemos acceder desde la página principal en la esquina superior izquierda.
    ![allOrders1](https://i.ibb.co/n8kWShG/Screenshot-27.png)
    
    Tambien desde nuestro __home__, en la aprte superior de nuestra tabla.
    ![allOrders2](https://i.ibb.co/dg6QcD8/Screenshot-16.png)
    ![allOrders2](https://i.ibb.co/syhMXd8/Screenshot-15.png)

# Barrido.

El barrido en la aplicacion se realiza debido a que podemos obtener pagos pendientes, pues el credito tarda en ser aprovado, este funciona de la siguiente manera:

1. Obtenemos todas las ordenes en estado pendiente del día de hoy.
2. Evaluamos que la horden tenga más de 7 minutos de antiguedad.
3. Si esta tiene más de 7 minutos evaluamos con PlacetoPay si el cridito ya ha sido aprobado, de ser asi secambia el estado (status).

Este codigo se ejecuta cada 15 minutos en nustra aplicación.

__NOTA: Debido a que Cron (administrador regular de procesos en segundo plano) no funciana en Windows si deseas probarlo te veras en la obligación de usar el programador de tareas de Windows, puedes seguir los siguientes tutoriales__

__-[Video](https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=6&cad=rja&uact=8&ved=2ahUKEwiWtsD7j57pAhUxmeAKHcMTAHQQwqsBMAV6BAgKEAQ&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DM2Ss0oUPBFQ&usg=AOvVaw2AsPFdh5TUGR1gACRjC6Z_)__

__-[Artículo](https://quantizd.com/how-to-use-laravel-task-scheduler-on-windows-10/)__

__Tambien puedes dirigirte al archivo "Kernel.php" ubicado en "app/Console" y la función "schedule" modificarla de la siguiente forma:__

```php
//$schedule->command('sweep:orders')->everyFifteenMinutes();
$schedule->command('sweep:orders')->everyMinute();
```

__Despues ejecutamos el comando "php artisan schedule:run", si tenemos ordenes pendiente con mas de 7 minutos de antiguedad y fueron aprovadas se actualizarán.__

# Pruebas.

Para las pruebas que se encuentran en __"test/Feature/OrderTest.php"__, realizadas con PHPUnit integrado con laravel.

1. Debemos configurar el archivo __"phpunit.xml"__ que se encuentra en la carpeta principal del proyecto, en este editaremos los parametros __DB_DATABASE__ y __DB_CONNECTION__ __por los mismos de nuestro archivo ".env"__.

![allOrders2](https://i.ibb.co/JcWchHv/Screenshot-21.png)

2. ya configurado el archivo __"phpunit.xml"__ podemos ejecutar las pruebas desde nuestra terminal con el comando __vendor/bin/phpunit__ lo que se busca con estas pruebas es verificar el funcionamiento de los metodos mas importantes de nuestro Controlador de ordenes.

Condiciones en la base de datos, para no tener dificultades en las pruebas.

* Tener minimo 1 usuario.
* Tener minimos 1 orden en cualquier estado.
* Tener minimo 1 orden rechazada status(3).

__NOTA: Si no se cumplen algunas condiciones en nuestra base de datos algunas pruebas podrian fallar.__

__Release/1.0__