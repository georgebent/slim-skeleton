# Slim Skeleton

## Requirements

- PHP >= 7.0.0
- NodeJS >= 7.10.1
- NPM >= 4.2.0
- SQLite3 PHP Extension

## Installation

After [download](https://github.com/georgebent/slim-skeleton/archive/master.zip) run:
```sh
composer install
npm install
```

## Configuration

Configuration file:
src/settings.php

Routing file:
src/routes.php

## Usage

All files for frontend in resources directory

for start application run:
```sh
composer serve
```

for creating frontend online use:
```sh
gulp
```

for adding frontend to project run:
```sh
gulp build
```

for adding route, you must add it to route.php file. For example:
```php
$app->get('/', 'App\Classes\Controller:index');
```

for using sqlite database, you must add db to database folder(or use current "data.sqlite"), entering settings in settings.php, and use. For example, add to function in Controller.php:
```php
$this->container['db']->query("SELECT * FROM works;");
```