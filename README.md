# FarmaX API (farmaceutica)

Backend desarrollado con Yii2 Framework para el sistema de gestión farmacéutica FarmaX.

Este proyecto proporciona la lógica de negocio, autenticación, gestión de usuarios, administración de medicamentos y acceso a la base de datos utilizada por la aplicación móvil AppFarmacia.

---

# Arquitectura del Sistema

```text
AppFarmacia (Ionic + Angular)
        │
        │ HTTP / JSON
        ▼
FarmaX API (Yii2)
        │
        ▼
      MySQL
```

---

# Descripción General

FarmaX API centraliza la gestión de información farmacéutica mediante una serie de controladores, modelos y servicios desarrollados en Yii2.

Entre las funcionalidades principales se encuentran:

* Gestión de usuarios.
* Autenticación y autorización.
* Administración de medicamentos.
* Gestión de componentes farmacológicos.
* Gestión de categorías de medicamentos.
* Administración de clientes.
* Gestión de compras.
* Gestión de pagos.
* Gestión de devoluciones.
* Administración de entidades comerciales.
* Gestión geográfica (países, estados, municipios y ciudades).
* Exposición de servicios para consumo desde aplicaciones externas.

---

# Tecnologías Utilizadas

## Backend

* PHP 7.4+
* Yii2 Framework 2.0
* Bootstrap 5
* Symfony Mailer

## Gestión de Usuarios y Roles

* Webvimark User Management

## Base de Datos

* MySQL

---

# Requisitos Previos

Antes de ejecutar el proyecto, asegúrate de tener instalado:

* PHP 7.4 o superior
* Composer
* MySQL
* Git

Verificar instalación:

```bash
php -v
composer -V
mysql --version
```

---

# Clonar el Proyecto

```bash
git clone https://github.com/BlackFenix937/farmaceutica.git
```

Ingresar al directorio:

```bash
cd farmaceutica
```

---

# Instalar Dependencias

Instalar dependencias mediante Composer:

```bash
composer install
```

---

# Configuración de Base de Datos

La conexión a la base de datos se encuentra en:

```text
config/db.php
```

Configuración por defecto:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=app_farmaceutica',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

Modificar los parámetros según la configuración local del servidor MySQL.

---

# Crear la Base de Datos

Crear una base de datos llamada:

```sql
CREATE DATABASE app_farmaceutica;
```

Posteriormente importar el archivo SQL correspondiente al proyecto.

---

# Ejecutar el Servidor

Iniciar el servidor de desarrollo de Yii2:

```bash
php yii serve
```

Por defecto el sistema estará disponible en:

```text
http://localhost:8080
```

---

# Conexión con AppFarmacia

La aplicación móvil AppFarmacia consume esta API mediante la siguiente configuración:

```typescript
export const environment = {
  production: true,
  apiUrl: "http://localhost:8080/"
};
```

Archivo:

```text
src/environments/environment.prod.ts
```

Si AppFarmacia se ejecuta desde un dispositivo físico, se recomienda utilizar la dirección IP local del servidor.

Ejemplo:

```typescript
apiUrl: "http://192.168.1.100:8080/"
```

---

# Estructura del Proyecto

```text
farmaceutica/
│
├── assets/
├── commands/
├── config/
├── controllers/
├── mail/
├── models/
├── runtime/
├── tests/
├── vagrant/
├── views/
├── web/
├── widgets/
│
├── composer.json
├── composer.lock
├── docker-compose.yml
├── yii
└── yii.bat
```

---

# Gestión de Usuarios y Roles

El proyecto incorpora:

* Autenticación de usuarios.
* Gestión de permisos.
* Control de acceso basado en roles.
* Administración centralizada de usuarios.

Implementado mediante:

```text
webvimark/module-user-management
```

---

# Funcionalidades Principales

* CRUD de medicamentos.
* CRUD de clientes.
* CRUD de compras.
* CRUD de pagos.
* CRUD de devoluciones.
* CRUD de componentes farmacológicos.
* CRUD de categorías de medicamentos.
* CRUD de entidades comerciales.
* Gestión geográfica completa.
* Servicios consumidos por AppFarmacia.

---

# Pruebas

El proyecto incluye configuración para Codeception.

Ejecutar pruebas:

```bash
vendor/bin/codecept run
```

---

# Licencia

Proyecto desarrollado con fines académicos y de gestión farmacéutica.

---

# Autor

**BlackFenix937** || **Andy de Jesús González Alcázar**

Backend del ecosistema FarmaX desarrollado con Yii2 Framework y MySQL.

# Documentación Oficial de Yii2

> Esta aplicación fue desarrollada sobre la plantilla oficial Yii2 Basic Project Template. La documentación original puede consultarse en:
>
> https://www.yiiframework.com/

<summary>Ver documentación original de Yii2</summary>

<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](https://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](https://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full-featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](https://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2basic_test` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.

</details>
