<?php
$appName = env('APP_NAME');
$env = env('APP_ENV');

return [
  'settings' => [
    'displayErrorDetails' => $env === 'dev',
    'debug' => $env === 'dev',
    'routerCacheFile' => $env === 'prod' ? storage_path('cache/router.php') : false,

    'logger' => [
      'name' => $appName,
      'level' => Monolog\Logger::DEBUG,
      'path' => storage_path('logs')
    ]
  ]
];