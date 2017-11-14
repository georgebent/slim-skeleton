<?php

// DIC configuration
$container = $app->getContainer();

// render view
$container['render'] = function ($c) {
    $settings = $c->get('settings')['render'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Sqlite DB
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    
    if(!isset($settings['sqlite']) || !$settings['sqlite']) {
        return false;
    }

    $path = $settings['sqlite'];
    $db = new \PDO($path) or die("cannot open the database");
    return $db;

};

// 404
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['render']->render($response->withStatus(404), '404.html');
    };
};
