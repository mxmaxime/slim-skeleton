<?php

use Emix\Asset\AssetInterface;
use Emix\Asset\TwigAssetExtension;
use Emix\Config\ConfigRepository;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container[AssetInterface::class] = function (ContainerInterface $container) {
  return new \Emix\Asset\Asset($container);
};

$container[TwigAssetExtension::class] = function (ContainerInterface $container) {
  return new \Emix\Asset\TwigAssetExtension($container[\Emix\Asset\AssetInterface::class]);
};

$view = new \App\Providers\ViewServiceProvider($app);
$view->run();
