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

  public function __construct (array $items) 
  {
    $this->items = $items;
  }

  public function get ($key, $default = NULL)
  {
    return Arr::get($this->items, $key, $default);
  }

  public function all ()
  {

  }

}