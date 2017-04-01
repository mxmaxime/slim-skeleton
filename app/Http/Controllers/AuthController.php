<?php

namespace App\http\Controllers;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthController extends BaseController
{

  public function __construct (ContainerInterface $container)
  {
    parent::__construct($container);
  }

  public function getAuth (RequestInterface $request, ResponseInterface $response)
  {
    return $this->render($response, 'auth.twig');
  }

}
