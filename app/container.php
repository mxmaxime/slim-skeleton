<?php

use Emix\Asset\Asset;
use Emix\Asset\TwigAssetExtension;
use Emix\Twig\Slim\TwigServiceProvider;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['config'] = function () use ($configRepository) {
  return $configRepository;
};

$container[\Emix\Support\PathHelpers::class] = function () use ($pathHelpers) {
  return $pathHelpers;
};

$container[Asset::class] = function (ContainerInterface $container) {
  $useWebpack = $_SERVER['ASSETS_WEBPACK'] ?? false;

  // In dev
  if ($useWebpack) {
    return new Asset();
  }

  return new Asset();
};

$container[TwigAssetExtension::class] = function (ContainerInterface $container) {
  return new \Emix\Asset\TwigAssetExtension($container[Asset::class]);
};

$view = new TwigServiceProvider($container);
$view->run();
