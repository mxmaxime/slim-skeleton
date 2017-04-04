<?php
namespace App\Providers;

// use Emix\asset\AssetInterface;

use Emix\Asset\TwigAssetExtension;
// use Emix\Twig\TwigCallApiExtension;
// use Emix\Twig\TwigMarkdownExtension;
// use Emix\Twig\TwigAuthExtension;

use Emix\Support\ServiceProvider;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_SimpleFunction;

class ViewServiceProvider extends ServiceProvider
{

  public function run ()
  {
    $this->container['view'] = function (ContainerInterface $container): Twig {
      $env = config('app.env');

      $view = new Twig(config('view.path'), [
        'debug' => $env === 'dev',
        'cache' => $env == 'prod' ? config('view.compiled') : false
      ]);

      if ($env === 'dev') {
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
