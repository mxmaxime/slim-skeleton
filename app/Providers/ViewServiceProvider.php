<?php
namespace App\Providers;

// use Emix\asset\AssetInterface;

use Emix\Asset\TwigAssetExtension;
// use Emix\Twig\TwigCallApiExtension;
// use Emix\Twig\TwigMarkdownExtension;
// use Emix\Twig\TwigAuthExtension;

use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_SimpleFunction;

class ViewServiceProvider
{

  private $container;

  public function __construct (ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function run ()
  {
    $this->container['view'] = function (ContainerInterface $container): Twig
    {
      $dir = dirname(dirname(__DIR__));

      $view = new Twig("$dir/resources/views", [
        'debug' => $_SERVER['ENV'] === 'dev',
        'cache' => $_SERVER['ENV'] == 'prod' ? '/path/to/cache' : false
      ]);

      if ($_SERVER['ENV'] === 'dev') {
        $view->addExtension(new \Twig_Extension_Debug());
      }

      // Instantiate and add Slim specific extension
      $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
      $view->addExtension(new TwigExtension($container['router'], $basePath));

      $twigEnv = $view->getEnvironment();

      // Add my extensions
      $assetExtension = $container->get(TwigAssetExtension::class);
      $twigEnv->addExtension($assetExtension);

      return $view;
    };
  }
}
