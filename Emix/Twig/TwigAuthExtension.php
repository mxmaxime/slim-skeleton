<?php
namespace Emix\Twig;

use Emix\Authenticated\Authenticated;
use Twig_Extension;

class TwigAuthExtension extends Twig_Extension
{

  private $authenticated;

  public function __construct (Authenticated $authenticated)
  {
    $this->authenticated = $authenticated;
  }

  public function getFunctions ()
  {
    return [
      new \Twig_SimpleFunction('getUser', [$this->authenticated, 'getUser'])
    ];
  }
}
