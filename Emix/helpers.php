<?php 

if (!function_exists('config')) {

  function config (String $config): String {
    return '';
  }

}

if (!function_exists('env')) {
  
  function env (String $key, String $default = NULL) {
    // isset($_SERVER[$key]) ? $_SERVER[$key] : $default
    return $_SERVER[$key] ?? $default;
  }

}

if (!function_exists('root_path')) {

  function root_path () {
    return realpath('../');
  }

}

if (!function_exists('config_path')) {

  function config_path () {
    return realpath('../config');
  }

}

if (!function_exists('storage_path')) {

  function storage_path (String $path): String {
    return realpath("../");
  }
}

if (!function_exists('resource_path')) {

  function resource_path (String $path): String {
    return realpath("../resources/$path");
  }

}

if (!function_exists('public_path')) {

  function public_path (): String {
    return realpath('./');
  }

}

if (!function_exists('storage_path')) {
  
  function storage_path (): String {
    return '';
  }

}