<?php

// Setup autoloader
require __DIR__ . '/../vendor/autoload.php';

// Prepare app
$settings = require __DIR__ . '/../app/settings.php';
$localSettings = require __DIR__ . '/../app/settings.local.php';

$app = new \Slim\App(array_replace_recursive($settings, $localSettings));

// Register dependencies
require __DIR__ . '/../app/dependencies.php';

// Register middleware
require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes.php';

// Run app
$app->run();