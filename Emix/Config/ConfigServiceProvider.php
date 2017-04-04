<?php

namespace Emix\Config;


use Emix\Config\ConfigRepository;
use Emix\Support\PathHelpers;
use Emix\Support\ServiceProvider;
use Psr\Container\ContainerInterface;

class ConfigServiceProvider
{
  /**
   * @var PathHelpers
   */
  private $path;

  private static $_instance;

  public function __construct(PathHelpers $path)
  {
    $this->path = $path;
  }

  public function boot (): ConfigRepository
  {

  }

//  public function register ()
//  {
//    $this->container[ConfigRepository::class] = function (ContainerInterface $container) {
//      return ConfigRepository::getInstance();
//    };
//  }

}