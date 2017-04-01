<?php
namespace Emix\Twig;

use Emix\CallApi\CallApi;
use Twig_Extension;

class TwigCallApiExtension extends Twig_Extension {

  private $callApi;
  private $container;

  public function __construct ($container, CallApi $callApi)
  {
    $this->container = $container;
    $this->callApi = $callApi;
  }

  public function getInstance ($apiName) 
  {
    $apiName = strtolower($apiName);
    $apiName = ucfirst($apiName);

    $className = "Call{$apiName}Api";
    return $this->container->get($className);
  }
  public function getFunctions () {
    return [
      new \Twig_SimpleFunction('callApi', [$this, 'getInstance'])
    ];
  }
}
