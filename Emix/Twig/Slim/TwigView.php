<?php

namespace Emix\Twig\Slim;

use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class TwigView
{

  /**
   * @var ContainerInterface
   */
  private $container;

  private $config;

  private $viewConfig;
  private $twigConfig;

  private $twig;
  private $twigEnv;

  private $env;

  /**
   * View constructor.
   * @param ContainerInterface $container
   * @throws \Exception
   */
  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;

    $config = $container->get('config');
    $env = $config->get('app.env');

    $c = $config->get('view');

    $viewConfig = $c['general'] ?? null;
    $twigConfig = $c['twig'] ?? null;

    if (!$viewConfig || !$twigConfig) {
      throw new \Exception('lol');
    }


    $this->twig = new Twig($twigConfig['path'], $twigConfig);
    $this->twigEnv = $this->twig->getEnvironment();

    $this->viewConfig = $viewConfig;
    $this->config = $config;
    $this->env = $env;
    $this->twigConfig = $twigConfig;

    $this->slim();
    $this->addGlobals();
    $this->addExtensions();
  }

  /**
   * Compatibility with slim framework
   */
  private function slim(): void
  {
    $basePath = rtrim(str_ireplace('index.php', '', $this->container['request']->getUri()->getBasePath()), '/');
    $this->twig->addExtension(new TwigExtension($this->container['router'], $basePath));
  }

  private function addGlobals(): void
  {
    $this->twigEnv->addGlobal('uri', $this->container['request']->getUri());
    $this->twigEnv->addGlobal('path', $this->container['request']->getUri()->getPath());
    // $this->addGlobals($container, $twigEnv);
  }

  private function addExtensions(): void
  {
    if ($this->env === 'dev') {
      $this->twig->addExtension(new \Twig_Extension_Debug());
    }

    $extensions = $this->viewConfig['extensions'];

    foreach($extensions as $ext) {
      $this->twigEnv->addExtension($this->container->get($ext));
    }
  }

  public function getTwig(): Twig
  {
    return $this->twig;
  }
}
