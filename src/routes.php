<?php

$app->get('/', 'App\Classes\Controller:home');
$app->get('/about', 'App\Classes\Controller:about');
$app->get('/contacts', 'App\Classes\Controller:contacts');
