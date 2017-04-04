<?php 

namespace  Emix\Config;

use Emix\Support\Arr;
use Emix\Support\PathHelpers;

/**
 * Dans items je vais avoir toutes les config, tableau associatif :
 * nom => [key => value, key => value]...
 */
class ConfigRepository
{

  private $items;

  /**
   * @var ConfigRepository
   */
  private static $_instance;

  public function __construct (array $items) 
  {
    $this->items = $items;
  }

  public static function getInstance (): ConfigRepository
  {
    if (!self::$_instance) {
      $configPath = PathHelpers::getInstance()->config;
      $arr = [];

      foreach (glob("${configPath}/*.config.php") as $path) {
        $filename = basename($path, '.config.php');
        $arr[basename($filename)] = include($path);
      }

      self::$_instance = new self($arr);
    }

    return self::$_instance;
  }

  public function get ($key, $default = NULL)
  {
    return Arr::get($this->items, $key, $default);
  }

  public function all ()
  {

  }

}