<?php

namespace Emix\Twig\Slim;

use Emix\Support\ServiceProvider;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;

class TwigServiceProvider extends ServiceProvider
{
  /**
   * ViewServiceProvider constructor.
   * @param ContainerInterface $container
   */
  public function __construct(ContainerInterface $container)
  {
    parent::__construct($container);
  }

  public function run(): void
  {
    $this->container['view'] = function (ContainerInterface $container): Twig {
      $viewBuilder = new TwigView($container);
      $view = $viewBuilder->getTwig();

      return $view;
    };
  }
}