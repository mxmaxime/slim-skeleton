<?php
namespace Emix\Asset;

use Twig_Extension;

class TwigAssetExtension extends Twig_Extension
{

  private $asset;

  public function __construct (Asset $asset)
  {
    $this->asset = $asset;
  }

  public function getFunctions () {
    return [
      new \Twig_SimpleFunction('asset', [$this->asset, 'path'])
    ];
  }
}
