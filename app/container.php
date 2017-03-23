<?php

use Emix\Asset\AssetInterface;
use Emix\Asset\TwigAssetExtension;

$container = $app->getContainer();

$container[AssetInterface::class] = function ($container) {
  return new \Emix\Asset\Asset($container);
};

$container[TwigAssetExtension::class] = function ($container) {
  return new \Emix\Asset\TwigAssetExtension($container[\Emix\Asset\AssetInterface::class]);
};

$view = new \App\Providers\ViewServiceProvider($container);
$view->run();
