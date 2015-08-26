<?php

$container = $app->getContainer();

// Formatters
$container['Formatters\Slack\Basic'] = function ($c) {
    return new \App\Formatters\Slack\Basic($c['Responses\Slack']);
};

// Authenticators
$container['Authenticators\Slack'] = $container->factory(function ($c) {
    return new \App\SlackAuthenticator();
});

// Responses
$container['Responses\Slack'] = $container->factory(function ($c) {
    return new \App\Responses\Slack();
});

// Actions
$container['Actions\Greeting'] = function ($c) {
    return new \App\Actions\Greeting(
        $c['Formatters\Slack\Basic'],
        $c['Authenticators\Slack'],
        $c['settings']['Actions\Greeting']
    );
};
$container['Actions\Date'] = function ($c) {
    return new \App\Actions\Date(
        $c['Formatters\Slack\Basic'],
        $c['Authenticators\Slack'],
        $c['settings']['Actions\Date']
    );
};

// Middleware
$container['SlackIncomingWebhook'] = function ($c) {
    return new \App\SlackIncomingWebhook($c['settings']['SlackIncomingWebhook']);
};