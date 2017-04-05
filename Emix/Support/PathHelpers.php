<?php

namespace Emix\Support;


class PathHelpers
{

  private $paths;

  private static $_instance;

  public function __construct()
  {
    $paths = [];

    $root = realpath('../');
    $paths['root'] = $root;

    $paths['config'] = $root . '/config';
    $paths['storage'] = $root . '/storage';
    $paths['resources'] = $root . '/resources';
    $paths['public'] = $root . '/public';

    $this->paths = $paths;
  }

  public static function getInstance ()
  {
    if (!self::$_instance) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  public function __get ($name)
  {
    return $this->paths[$name] ?? null;
  }


}