<?php

require('../vendor/autoload.php');

// Load the configuration
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$pathHelpers = \Emix\Support\PathHelpers::getInstance();
require('../Emix/helpers.php');

$configRepository = \Emix\Config\ConfigRepository::getInstance();

$config = [
    'settings' => [
        'displayErrorDetails' => $configRepository->get('app.env') === 'dev',
    ]
];

// Create the slim application
$app = new \Slim\App($config);

// Mount object into the container
require('../app/container.php');


// Mount the routes
require('../routes/web.php');

$app->run();
