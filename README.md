# MiniBlog Service



This repository is developed for Laravel Framework 10 or higher.

## Contents

- [Installation](#installation)
- [Dependencies](#dependencies)
- [Configuration](#configuration)
  - [Laravel Media Library](#spatie-laravel-medialibrary)
  - [L5-Swagger](#l5-swagger)
  - [Modify the main composer file](#modify-the-main-composer-file)
  - [Providers](#providers)
  - [Authentication](#authentication)
  - [Routes](#routes)
  - [Views](#views)
  - [Include custom Middleware](#include-custom-middleware)
  - [Publish files](#publish-files)
  - [CSS and JavaScript pre-processors](#css-and-javascript-pre-processors)
    - [Laravel Mix](#laravel-mix)
    - [Vite](#vite)
  - [Migrations](#migrations)
- [Tests](#Tests)

## Installation
* Create a new Laravel project with the following command:
    ```shell
    composer create-project laravel/laravel project-name
    ```
* If you have file/photo fields, run
    ```shell
    php artisan storage:link
    ```
* Open your project installation root directory in the terminal and run:
    ```sh
    git clone git@github.com:mpernia/miniblog.git src
    ```


## Dependencies
This repository requires the following dependencies:

* yajra/laravel-datatables-oracle
* spatie/laravel-medialibrary
* laravel/ui
* darkaonline/l5-swagger

To install the required libraries in the terminal move to the root dir and run this commands:

*
  ```sh
    composer require yajra/laravel-datatables-oracle spatie/laravel-medialibrary darkaonline/l5-swagger
  ```
*
  ```sh
  composer require laravel/ui --dev
  ```
  

## Configuration

### Laravel Media Library

You need to publish the migration to create the media table:

```php
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```
Publishing the config file is optional:

```php
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
```

By default, the media library will store its files on Laravel's public disk. If you want a dedicated disk you should add a disk to `config/filesystems.php`. This would be a typical configuration:

```php
    'disks' => [
        'media' => [
            'driver' => 'local',
            'root'   => public_path('media'),
            'url'    => env('APP_URL').'/media',
        ],
```

If you configure a dedicated disk you need to edit the config file `media-library.php` and change the default value in disk_name parameter like this code:

```php

'disk_name' => 'media',

```

### L5-Swagger 

#### Installation and Configuration

To install Swagger in Laravel we are going to use the L5-Swagger module on GitHub. You can check the information about the integration developed by DarkaOnLine at [Installation & Configuration](https://github.com/DarkaOnLine/L5-Swagger/wiki/Installation-&-Configuration).

### Modify the main composer file

Edit the file `composer.json` and put this code:

```json
{
    "autoload": {
        "psr-4": {
            "MiniBlog\\": "src/"
        },
        "files": [
            "src/BoundedContext/Backoffice/Infrastructure/Helpers/helpers.php",
            "src/BoundedContext/Frontend/Infrastructure/Helpers/helpers.php",
            "src/Shared/Infrastructure/Helpers/helpers.php"
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "MiniBlog\\Tests\\": "src/Tests/"
        }
    }
}
```

### Providers
Edit the file `config/app.php` and put this code:
```php
'providers' => [
    MiniBlog\Shared\Infrastructure\Providers\RouteServiceProvider::class,
    MiniBlog\Shared\Infrastructure\Providers\SourceServiceProvider::class,
];
```

### Authentication
Edit the file `config/auth` and change the model class in providers array:
```php
[
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => MiniBlog\Shared\Infrastructure\Persistences\Models\User::class
        ],
    ],
];
```

### Routes
You can see the routes inside `src/Shared/Infrastructure/Routes` directory.

### Views
Edit `config/view.php` and change the **paths** value:
```php
'paths' => [
    base_path('src/Shared/Infrastructure/Resources/views')
],
````

### Include custom Middleware
Edit the file `app/Http/Kernel.php` and put this code:

```php
    protected $middlewareGroups = [
        'web' => [
            \MiniBlog\Shared\Infrastructure\Middlewares\AuthGates::class,
            \MiniBlog\Shared\Infrastructure\Middlewares\SetLocale::class,
        ],
        'api' => [
            \MiniBlog\Shared\Infrastructure\Middlewares\AuthGates::class,
        ],
    ];

    protected $routeMiddleware = [
        'admin'    => \MiniBlog\BoundedContext\Backoffice\Infrastructure\Middlewares\IsAdmin::class,
        'frontend' => \MiniBlog\BoundedContext\Frontend\Infrastructure\Middlewares\Frontend::class,
        'isguest'  => \MiniBlog\Shared\Infrastructure\Middlewares\IsAuthenticated::class,
    ];
```

### Publish files
The **vendor:publish** command is used to publish any assets that are available from third-party vendor packages.

The following commands lists and describes each of:
* Config
    ```sh
    php artisan vendor:publish --tag=miniblog.config
    ```
* Seeders
    ```sh
    php artisan vendor:publish --tag=miniblog.seeders
    ```
* Assets
    ```sh
    php artisan vendor:publish --tag=miniblog.assets
    ```
* Languages
    ```sh
    php artisan vendor:publish --tag=miniblog.lang
    ```

**Publish all**, you can publish all in one command:
```sh
php artisan vendor:publish --provider="MiniBlog\Shared\Infrastructure\Providers\SourceServiceProvider"
```
**Note:** add this flag `--force` to overwrite any existing files.


### CSS and JavaScript pre-processors

#### Laravel Mix

* Install laravel mix run this code:

```sh
yarn add laravel-mix
```

* Delete the file: `vite.config.js` or rename to `webpack.mix.js`.

* Put inside the file `webpack.mix.js` this code:

```js
mix.js('src/Shared/Resources/assets/backoffice/js/app.js', 'public/assets/backoffice/js')
    .postCss('src/Shared/Resources/assets/backoffice/css/app.css', 'public/assets/backoffice/css');

mix.js('src/Shared/Resources/assets/frontend/js/app.js', 'public/assets/frontend/js')
    .postCss('src/Shared/Resources/assets/frontend/css/app.css', 'public/assets/frontend/css');
```

* Edit the file `package.json` and put this code:

```json
{
  "scripts": {
    "dev": "npm run development",
    "development": "mix",
    "watch": "mix watch",
    "watch-poll": "mix watch -- --watch-options-poll=1000",
    "hot": "mix watch --hot",
    "prod": "npm run production",
    "production": "mix --production"
  }
}
```

##### Remove Laravel Mix

The Laravel Mix package can now be uninstalled:

```sh
npm remove laravel-mix
```

And you may remove your Mix configuration file:

```sh
rm webpack.mix.js
```

**Notice**: Vite has replaced Laravel Mix in new Laravel installations.

#### Vite

##### Install Vite and the Laravel Plugin

* First, you will need to install [Vite](https://vitejs.dev/) and the [Laravel Vite Plugin](https://www.npmjs.com/package/laravel-vite-plugin) using your npm package manager of choice:

```sh
npm install --save-dev vite laravel-vite-plugin
```

* You may also need to install additional Vite plugins for your project, such as the Vue or React plugins:

```sh
npm install --save-dev @vitejs/plugin-vue
```

```sh
npm install --save-dev @vitejs/plugin-react
```

##### Configure Vite

* Create a `vite.config.js` file in the root of your project:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'src/Shared/Resources/assets/backoffice/js/app.js',
            'src/Shared/Resources/assets/backoffice/css/app.css',
            'src/Shared/Resources/assets/frontend/js/app.js',
            'src/Shared/Resources/assets/frontend/css/app.css',
        ]),
    ],
});
```

##### Remove Vite and the Laravel Plugin

Vite and the Laravel Plugin can now be uninstalled:

```sh
npm remove vite laravel-vite-plugin
```

Next, you may remove your Vite configuration file:

```sh
rm vite.config.js
```


### Migrations
* Run this command to create all tables and insert the initial data:
    ```sh
    php artisan migrate --seed command. 
    ```
**Notice:** seed is important, because it will create the first admin user for you.

And that's it, go to your domain and login:

### Default credentials
* **Username:** admin@admin.com
* **Password:** password


## Tests

Edit the file `phpunit.xml` and put this code inside `testsuites` tag:

```xml
    <testsuite name="FeatureTest">
        <directory suffix="Test.php">./src/Tests/Feature</directory>
    </testsuite>
    <testsuite name="UnitTest">
        <directory suffix="Test.php">./src/Tests/Unit</directory>
    </testsuite>
```


