<?php

namespace Emix\Support;


use Slim\App;

abstract class ServiceProvider
{
  /**
   * @var App
   */
  private $app;

  /**
   * @var \Psr\Container\ContainerInterface
   */
  protected $container;

  public function __construct (App $app)
  {
    $this->app = $app;
    $this->container = $app->getContainer();
  }
}