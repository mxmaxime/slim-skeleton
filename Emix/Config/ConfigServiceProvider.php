<?php

namespace Emix\Config;


use Emix\Config\ConfigRepository;
use Emix\Support\PathHelpers;
use Emix\Support\ServiceProvider;
use Psr\Container\ContainerInterface;

class ConfigServiceProviderr
{
  /**
   * @var PathHelpers
   */
  private $path;

  public function __construct(PathHelpers $path)
  {
    $this->path = $path;
  }

  public function boot (): ConfigRepository
  {
    $configPath = config_path();
    $arr = [];

    foreach (glob("${configPath}/*.config.php") as $path) {
      $filename = basename($path, '.config.php');
      $arr[basename($filename)] = include($path);
    }

    return ConfigRepository::getInstance($arr);
  }

//  public function register ()
//  {
//    $this->container[ConfigRepository::class] = function (ContainerInterface $container) {
//      return ConfigRepository::getInstance();
//    };
//  }

}