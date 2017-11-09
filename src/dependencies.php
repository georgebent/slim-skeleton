<?php

// DIC configuration
$container = $app->getContainer();

// render view
$container['renderer'] = function ($c) {
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

// 404
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['renderer']->render($response->withStatus(404), '404.html');
    };
};
