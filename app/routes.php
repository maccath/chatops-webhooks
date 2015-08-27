<?php

$container = $app->getContainer();
$actionString = implode($container['actions'], '|');

// Slack response
$app->group('/{type:slack}', function () use ($actionString) {
    $this->post('/{action:' . $actionString . '}', function($request, $response, $args) {
        $container = $this->getContainer();

        $container['errorHandler'] = function ($c) {
            return new $c['ErrorHandlers\Slack'];
        };

        $container['Action'] = $args['action'];
        $container['ActionExecutor\Slack']($request, $response, $args);
    })->setName('slack_action')->add('SlackIncomingWebhook:send');
});

// JSON responses
$app->post('/{action:' . $actionString . '}', function($request, $response, $args) {
    $container = $this->getContainer();

    $container['errorHandler'] = function ($c) {
        return new $c['ErrorHandlers\Json'];
    };

    $container['Action'] = $args['action'];
    $container['ActionExecutor']($request, $response, $args);
})->setName('action');