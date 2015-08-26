<?php

$app->post('/greet', function($request, $response, $args) {
    $container = $this->getContainer();
    $container['Actions\Greeting']($request, $response, $args);
})->setName('greet');

$app->post('/date', function($request, $response, $args) {
    $container = $this->getContainer();
    $container['Actions\Date']($request, $response, $args);
})->setName('date');

$app->post('/random', function($request, $response, $args) {
    $container = $this->getContainer();
    $container['Actions\Random']($request, $response, $args);
})->setName('random');