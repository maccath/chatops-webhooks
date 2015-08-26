<?php

// Slack response
$app->group('/{type:slack}', function () {
    $this->post('/{action:greet|random|date}', function($request, $response, $args) {
        $container = $this->getContainer();

        $container['errorHandler'] = function ($c) {
            return new $c['ErrorHandlers/Slack'];
        };

        $container['Actions\\'.ucwords($args['type']).'\\'.ucwords($args['action'])]($request, $response, $args);
    })->setName('slack_action')->add('SlackIncomingWebhook:send');
});

// JSON responses
$app->post('/{action:greet|random|date}', function($request, $response, $args) {
    $container = $this->getContainer();

    $container['errorHandler'] = function ($c) {
        return new $c['ErrorHandlers/Json'];
    };

    $container['Actions\\'.ucwords($args['action'])]($request, $response, $args);
})->setName('action');