<?php

namespace Emix\Asset;

use Psr\Container\ContainerInterface;

class Asset implements AssetInterface {

  public $json = null;
  private $file = 'http://localhost:8080/assets/assets.json';
  private $files;
  private $useWebpack;

  public function __construct (ContainerInterface $container) {
    $config = $container->get('config');

    $this->useWebpack = $config->get('asset.use_webpack') === true;

    if (!$this->isLocal() || $this->useWebpack === false) {
      $assetsInformations = json_decode(file_get_contents(public_path() . '/assets/assets.json'));

      foreach ($assetsInformations as $assetInformations) {
        foreach ($assetInformations as $key => $value) {

          preg_match("/[a-z]+\.\w+/", $value, $filename); // On récupère le filename avec le hash
          $filename = $filename[0];

          preg_match('/^\w+/', $filename, $filename); // On delete le hash
          $filename = $filename[0];

          $this->files[$key][$filename] = $value;
        }
      }
    }
  }

  public function path (String $file) {
    $parts = explode('.', $file);

    if ($this->isLocal() === true && $this->useWebpack === true) {
      if ($parts[1] === 'css') {
        return; // Parce qu'en mode developpement c'est le fichier javascript qui injecte le style ;)
      }

      return 'http://localhost:3003/assets/'.$file;
    }

    $files = $this->files[$parts[1]]; // $parts[1] = l'extension
    return $files[$parts[0]];
  }

  private function isLocal () {
    return strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;
  }
}
