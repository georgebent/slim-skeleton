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

for using sqlite database, you must add db to database folder(or use current "data.sqlite"), entering settings in settings.php and use. For example, add to function in Controller.php:
```php
$this->container['db']->query("SELECT * FROM works;");
```

## License

MIT License

Copyright (c) 2017 George Bent

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
