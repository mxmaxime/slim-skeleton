<?php
namespace Emix\Asset;

use Emix\asset\AssetInterface;
use Twig_Extension;

class TwigAssetExtension extends Twig_Extension {

  private $asset;

  public function __construct (AssetInterface $asset) {
    $this->asset = $asset;
  }

  public function getFunctions () {
    return [
      new \Twig_SimpleFunction('asset', [$this->asset, 'path'])
    ];
  }
}
