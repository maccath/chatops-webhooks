<?php

$container = $app->getContainer();

// Responses
$container['Responses\Slack'] = function($c) {
    return new \App\Responses\Slack();
};

// Formatters
$container['Formatters\Slack\Basic'] = function($c) {
    $response = $c['Responses\Slack'];

    return new \App\Formatters\Slack\Basic($response);
};