<?php 

namespace  Emix\Config;

use Emix\Support\Arr;

/**
 * Dans items je vais avoir toutes les config, tableau associatif :
 * nom => [key => value, key => value]...
 */
class Repository
{

  private $items;

  private static $_instance;

  public function __construct (array $items) 
  {
    $this->items = $items;
  }

  public static function getInstance (array $items)
  {
    if (!self::$_instance) {
      self::$_instance = new Repository($items);
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