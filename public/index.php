<?php

require('../vendor/autoload.php');
require('../Emix/helpers.php');

// Load the configuration
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$config = [
    'settings' => [
        'displayErrorDetails' => config('app.env') === 'dev',
    ]
];

// Create the slim application
$app = new \Slim\App($config);

// Mount object into the container
require('../app/container.php');

// Mount the routes
require('../routes/web.php');

$app->run();
