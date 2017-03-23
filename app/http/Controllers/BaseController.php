<?php
namespace App\http\Controllers;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class BaseController
{

  private $container;

  public function __construct (ContainerInterface $container)
  {
    $this->container = $container;
  }

  protected function render (ResponseInterface $response, $file, $data = [])
  {
    return $this->container->view->render($response, $file, $data);
  }

}
