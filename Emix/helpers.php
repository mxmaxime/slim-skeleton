<?php
use Emix\Support\PathHelpers;

if (!function_exists('env')) {
  
  function env (String $key, String $default = NULL) {
    // isset($_SERVER[$key]) ? $_SERVER[$key] : $default
    return $_SERVER[$key] ?? $default;
  }

}

if (!function_exists('resource_path')) {
  function resource_path (String $path): String {
    return PathHelpers::getInstance()->resources . '/' . $path;
  }
}

if (!function_exists('storage_path')) {

  function storage_path (String $path): String {
    return PathHelpers::getInstance()->storage . '/' . $path;
  }

}
