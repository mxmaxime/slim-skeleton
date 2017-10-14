<?php

require __DIR__ . '/pathHelpers.php';

if (!function_exists('env')) {
  function env(String $key, String $default = null)
  {
    // isset($_SERVER[$key]) ? $_SERVER[$key] : $default
    return $_SERVER[$key] ?? $default;
  }
}