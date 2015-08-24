<?php

$container = $app->getContainer();
$settings = $container->get('settings');

// Responses
$container['Responses\Slack'] = function($c) {
    return new \App\Responses\Slack();
};

// Formatters
$container['Formatters\Slack\Basic'] = function($c) {
    $response = $c['Responses\Slack'];

    return new \App\Formatters\Slack\Basic($response);
};

// Actions
$container['Actions\Greeting'] = function($c) use ($settings) {
    $formatter = $c['Formatters\Slack\Basic'];

    return new \App\Actions\Greeting($formatter, $settings['Actions\Greeting']);
};
