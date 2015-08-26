<?php

$container = $app->getContainer();

// Formatters
$container['Formatters\Slack\Basic'] = function ($c) use ($settings) {
    return new \App\Formatters\Slack\Basic($c['Responses\Slack']);
};

// Authenticators
$container['Authenticators\Slack'] = $container->factory(function ($c) use ($settings) {
    return new \App\SlackAuthenticator();
});

// Responses
$container['Responses\Slack'] = $container->factory(function ($c) use ($settings) {
    return new \App\Responses\Slack();
});

// Actions
$container['Actions\Greeting'] = function ($c) use ($settings) {
    return new \App\Actions\Greeting(
        $c['Formatters\Slack\Basic'],
        $c['Authenticators\Slack'],
        $settings['Actions\Greeting']
    );
};
$container['Actions\Date'] = function ($c) use ($settings) {
    return new \App\Actions\Date(
        $c['Formatters\Slack\Basic'],
        $c['Authenticators\Slack'],
        $settings['Actions\Date']
    );
};
$container['Actions\Random'] = function ($c) use ($settings) {
    return new \App\Actions\Random(
        $c['Formatters\Slack\Basic'],
        $c['Authenticators\Slack'],
        $settings['Actions\Random']
    );
};

// Middleware
$container['SlackIncomingWebhook'] = function ($c) use ($settings) {
    return new \App\SlackIncomingWebhook($settings['SlackIncomingWebhook']);
};