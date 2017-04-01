<?php
namespace App\http\Controllers;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

class BaseController
{

  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * @var Twig
   */
  private $view;

  public function __construct (ContainerInterface $container)
  {
    $this->container = $container;
    $this->view = $container->get('view');
  }

  protected function render (ResponseInterface $response, $file, $data = []): ResponseInterface
  {
    return $this->view->render($response, $file, $data);
  }

}
