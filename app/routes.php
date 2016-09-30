<?php

$container = $app->getContainer();
$actionString = strtolower(implode($container['actions'], '|'));



// Slack responses
$app->group('/{type:slack}', function () use ($actionString) {
    $container = $this->getContainer();

    $container['errorHandler'] = function ($c) {
        return new $c['ErrorHandlers\Slack'];
    };

    $this->post('/{action:' . $actionString . '}', function($request, $response, $args) {

    })->setName('slack_action')
        ->add('Authenticators\Slack')
        ->add('ActionExecutor\Slack')
        ->add('SlackIncomingWebhook:send');
});



// JSON responses
$app->post('/{action:' . $actionString . '}', function($request, $response, $args) {

})->setName('action')

    ->add('Authenticators\Basic')->add(function ($req, $rep, $next) {
        $container = $this->errorHandler;
        var_dump($container);
        $container['errorHandler'] = function ($c) {
            return new $c['ErrorHandlers\Json'];
        };

        $next($req, $rep);
    })
    ->add('ActionExecutor');

