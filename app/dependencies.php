<?php

$container = $app->getContainer();

// Actions
$container['actions'] = [
    'Greet',
    'Random',
    'Date'
];

// Authenticators
$container['authenticators'] = [
    'Basic',
    'Slack'
];

// Responses
$container['responses'] = [
    'Slack',
    'Plain',
    'Json'
];

// Error Handlers
$container['errorHandlers'] = [
    'Slack',
    'Json'
];

// Register Actions
foreach ($container['actions'] as $action) {
    $actionClass = "\\App\\Actions\\$action";
    $container["Actions\\$action"] = function ($c) use ($action, $actionClass) {
        return new $actionClass();
    };
}

// Register Authenticators
foreach ($container['authenticators'] as $authenticator) {
    $authenticatorClass = "\\App\\Authenticators\\$authenticator";
    $container["Authenticators\\$authenticator"] = $container->factory(function ($c) use ($authenticatorClass) {
        return new $authenticatorClass($c['settings']['authentication']);
    });
}

// Register Response Types
foreach ($container['responses'] as $response) {
    $responseClass = "\\App\\Responses\\$response";
    $container["Responses\\$response"] = $container->factory(function ($c) use ($responseClass) {
        return new $responseClass();
    });
}

// Register error Handlers
foreach ($container['errorHandlers'] as $errorHandler) {
    $errorHandlerClass = "\\App\\ErrorHandlers\\$errorHandler";
    $container["ErrorHandlers\\$errorHandler"] = $container->factory(function ($c) use ($errorHandlerClass) {
        return new $errorHandlerClass();
    });
}

// Middleware
$container['SlackIncomingWebhook'] = function ($c) {
    return new \App\SlackIncomingWebhook($c['settings']['SlackIncomingWebhook']);
};

// Action executors
$container['ActionExecutor'] = function ($c) {
    $action = 'Greet';

    return new \App\Actions\ActionExecutor(
        $c["Actions\\$action"],
        $c['Responses\Json'],
        isset($c['settings']["Actions\\$action"]) ? $c['settings']["Actions\\$action"] : []
    );
};

$container['ActionExecutor\Slack'] = function ($c) {
    $action = 'Greet';

    return new \App\Actions\ActionExecutor(
        $c["Actions\\$action"],
        $c['Responses\Slack'],
        isset($c['settings']["Actions\\$action"]) ? $c['settings']["Actions\\$action"] : []
    );
};

