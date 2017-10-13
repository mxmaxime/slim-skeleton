<?php
require('../vendor/autoload.php');

use Psr7Middlewares\Middleware\TrailingSlash;

// Load the configuration
$dotenv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$pathHelpers = \Emix\Support\PathHelpers::getInstance();
require('../app/helpers/helpers.php');
$configRepository = \Emix\Config\ConfigRepository::getInstance($pathHelpers->config);


$slimConfig = $configRepository->get('slim');
if (!$slimConfig) {
  throw new Exception("The slimg config is empty !");
}

$app = new \Slim\App($slimConfig);

require('../app/container.php');

$app->add(new TrailingSlash(false)); // true adds the trailing slash (false removes it)
require_once '../app/Http/routes.php';

$app->run();
