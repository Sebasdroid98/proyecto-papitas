## Proyecto papitas

## Cambios de la versión

- [] Se agrega autenticación basada en freeze
- [] Se agrega conexion a bases Oracle

## Corrección de errores
- [] No hay correcciones

## Pagina de la librería

- [Página oficial librería yajra](https://github.com/yajra/laravel-oci8)

## Instalar conexion oracle libreria
- [] composer require yajra/laravel-oci8

## Activar en php.ini las extensiones
- [] extension=oci8_12c  ; Use with Oracle Database 12c Instant Client
- [] extension=oci8_19  ; Use with Oracle Database 19 Instant Client
- [] extension=pdo_oci

## Agregar a los providers lo siguiente
- [] Yajra\Oci8\Oci8ServiceProvider::class,

## Agregar a los aliases lo siguiente
- [] 'OracleDB' => Yajra\Oci8\Oci8ServiceProvider::class,

## Ejecutar el comando
- [] php artisan vendor:publish --tag=oracle

## Se configuran los datos en el .env
- [] DB_CONNECTION=oracle
- [] DB_HOST=127.0.0.1
- [] DB_PORT=1521
- [] DB_DATABASE=xe
- [] DB_USERNAME=user
- [] DB_PASSWORD=pass

## Se ejecutan las migraciones
- [] php artisan migrate

## License (English - Ingles)

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
