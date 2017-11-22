<?php

/**
 * DIC configuration
 */
$container = $app->getContainer();

/**
 * Render view
 *
 * @param $c
 * @return \Slim\Views\PhpRenderer
 */
$container['render'] = function ($c) {
    $settings = $c->get('settings')['render'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

/**
 * Monolog
 *
 * @param $c
 * @return \Monolog\Logger
 */
$container['logger'] = function ($c) {

    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;

};

/**
 * SQLite DB
 *
 * @param $c
 * @return bool|PDO
 */
$container['db'] = function ($c) {

    $settings = $c->get('settings')['db'];
    
    if(!isset($settings['sqlite']) || !$settings['sqlite']) {
        return false;
    }

    $path = $settings['sqlite'];
    $db = new \PDO($path) or die("Cannot open the database");
    return $db;

};


/**
 * 404
 *
 * @param $c
 * @return Closure
 */
$container['notFoundHandler'] = function ($c) {

    return function ($request, $response) use ($c) {

        return $c['render']->render($response->withStatus(404), '404.html');

    };

};
