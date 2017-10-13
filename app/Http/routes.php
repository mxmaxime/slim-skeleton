<?php

$app->get('/', function ($req, $res) {
  echo "hello world";
})->setName('home');

$app->get('/home', \App\Http\Controllers\HomeController::class . ':home')->setName('auth');
