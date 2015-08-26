<?php

$container = $app->getContainer();

// Register Authenticators
$container['Authenticators\Slack'] = $container->factory(function ($c) {
    return new \App\Authenticators\Slack();
});
$container['Authenticators\Basic'] = $container->factory(function ($c) {
    return new \App\Authenticators\Basic();
});

// Register Response Types
$container['Responses\Slack'] = $container->factory(function ($c) {
    return new \App\Responses\Slack();
});
$container['Responses\Json'] = $container->factory(function ($c) {
    return new \App\Responses\Json();
});

// Register Actions
$actions = array('Greet', 'Date', 'Random');

foreach ($actions as $action) {
    $actionClass = '\App\Actions\\'.$action;

    $container['Actions\Slack\\'.$action] = function ($c) use ($action, $actionClass) {
        return new $actionClass(
            $c['Responses\Slack'],
            $c['Authenticators\Slack'],
            $c['settings']['Actions\\'.$action]
        );
    };

    $container['Actions\\'.$action] = function ($c) use ($action, $actionClass) {
        return new $actionClass(
            $c['Responses\Json'],
            $c['Authenticators\Basic'],
            $c['settings']['Actions\\'.$action]
        );
    };
}

// Error Handlers
$container['ErrorHandlers/Slack'] = function ($c) {
    return new \App\ErrorHandlers\Slack();
};
$container['ErrorHandlers/Json'] = function($c) {
    return new \App\ErrorHandlers\Json();
};

// Middleware
$container['SlackIncomingWebhook'] = function ($c) {
    return new \App\SlackIncomingWebhook($c['settings']['SlackIncomingWebhook']);
};
