<?php

$app->get('/', function ($req, $res) {
  echo "hello world";
})->setName('home');

$app->get('/auth', \App\http\Controllers\AuthController::class . ':getAuth')->setName('auth');
