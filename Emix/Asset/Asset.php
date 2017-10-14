<?php

namespace Emix\Asset;

class Asset
{

  /**
   * @var array
   */
  private $files;

  /**
   * @var String
   */
  private $assetsUri;

  /**
   * @var Asset
   */
  private static $_instance;

  /**
   *
   * @param null|String $assetPathFile - Si c'est pour la prod je donne que $assetPathfile
   * @param null|String $assetsUri - Si c'est pour le dev, je donne l'uri
   */
  public function __construct(?String $assetPathFile = null, ?String $assetsUri = null)
  {
    $this->assetsUri = $assetsUri;

    // In production, we use the assets.json file.
    if ($assetPathFile) {
      $assetsInformation = json_decode(file_get_contents($assetPathFile));

      foreach ($assetsInformation as $assetInformation) {
        foreach ($assetInformation as $key => $value) {

          // Get filename with hash
          preg_match("/\w+\.\w+/", $value, $filename);
          $filename = $filename[0];

          // Hash deletation
          preg_match('/^\w+/', $filename, $filename);
          $filename = $filename[0];

          $this->files[$key][$filename] = $value;
        }
      }
    }
  }

  /**
   * @param null|String $assetPathFile
   * @param null|String $assetsUri
   * @return Asset
   */
  public static function getInstance(?String $assetPathFile = null, ?String $assetsUri = null)
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new Asset($assetPathFile, $assetsUri);
    }

    return self::$_instance;
  }

  /**
   * @param String $file
   * @return null|String
   */
  public function path(String $file): ?String
  {
    $parts = explode('.', $file);

    if ($this->assetsUri) {
      // Because in dev it's the js file who's inject the style
      if ($parts[1] === 'css') {
        return null;
      }

      return $this->assetsUri . '/' . $file;
    }

    $files = $this->files[$parts[1]]; // $parts[1] = file extension
    return $files[$parts[0]];
  }

}