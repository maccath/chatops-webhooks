<?php

// Autoloader
require __DIR__ . '/../vendor/autoload.php';

// Get app settings
$globalSettings = require __DIR__ . '/../app/settings.php';
$localSettings = require __DIR__ . '/../app/settings.local.php';

$container = new \Slim\Container(array(
    'settings' => array_replace_recursive($globalSettings, $localSettings)
));

$app = new \Slim\App($container);

// Register dependencies
require __DIR__ . '/../app/dependencies.php';

// Register routes
require __DIR__ . '/../app/routes.php';

// Run app
$app->run();