<?php

$container = $app->getContainer();

// Actions
$container['actions'] = [
    'greet',
    'random',
    'date'
];

$container['authenticators'] = [
    'basic',
    'slack'
];

$container['responses'] = [
    'slack',
    'plain',
    'json'
];

$container['errorHandlers'] = [
    'slack',
    'json'
];

// Register Authenticators
foreach ($container['authenticators'] as $authenticator) {
    $authenticatorClassName = '\App\Authenticators\\' . ucwords($authenticator);
    $container['Authenticators\\'.ucwords($authenticator)] = $container->factory(function ($c) use ($authenticatorClassName) {
        return new $authenticatorClassName();
    });
}

// Register Response Types
foreach ($container['responses'] as $response) {
    $responseClassName = '\App\Responses\\' . ucwords($response);
    $container['Responses\\'.ucwords($response)] = $container->factory(function ($c) use ($responseClassName) {
        return new $responseClassName();
    });
}

// Action executors
$container['ActionExecutor\Slack'] = function ($c) {
    return new \App\Actions\ActionExecutor(
        $c['Actions\\'.ucwords($c['Action'])],
        $c['Responses\Slack'],
        $c['Authenticators\Slack'],
        $c['settings']['Actions\\'.ucwords($c['Action'])]
    );
};
$container['ActionExecutor'] = function ($c) {
    return new \App\Actions\ActionExecutor(
        $c['Actions\\'.ucwords($c['Action'])],
        $c['Responses\Json'],
        $c['Authenticators\Basic'],
        $c['settings']['Actions\\'.ucwords($c['Action'])]
    );
};


// Register Actions
foreach ($container['actions'] as $action) {
    $actionClass = '\App\Actions\\'.ucwords($action);

    $container['Actions\\'.ucwords($action)] = function ($c) use ($action, $actionClass) {
        return new $actionClass();
    };
}

// Register error Handlers
foreach ($container['errorHandlers'] as $errorHandler) {
    $errorHandlerClassName = '\App\ErrorHandlers\\' . ucwords($errorHandler);
    $container['ErrorHandlers\\'.ucwords($errorHandler)] = $container->factory(function ($c) use ($errorHandlerClassName) {
        return new $errorHandlerClassName();
    });
}

// Middleware
$container['SlackIncomingWebhook'] = function ($c) {
    return new \App\SlackIncomingWebhook($c['settings']['SlackIncomingWebhook']);
};
