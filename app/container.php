<?php

use Emix\Asset\AssetInterface;
use Emix\Asset\TwigAssetExtension;
use Emix\Config\Repository;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container[AssetInterface::class] = function (ContainerInterface $container) {
  return new \Emix\Asset\Asset($container);
};

$container[TwigAssetExtension::class] = function (ContainerInterface $container) {
  return new \Emix\Asset\TwigAssetExtension($container[\Emix\Asset\AssetInterface::class]);
};

// Add configuration
$container[Repository::class] = function (ContainerInterface $container) {
  $configPath = config_path();
  $arr = [];

  foreach (glob("${configPath}/*.config.php") as $path) {
    $filename = basename($path, '.config.php');
    $arr[basename($filename)] = include($path);
  }

  return $arr;
};

$view = new \App\Providers\ViewServiceProvider($container);
$view->run();
