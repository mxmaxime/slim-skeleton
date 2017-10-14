<?php
use Emix\Support\PathHelpers;

if (!function_exists('root_path')) {
  function root_path()
  {
    return realpath('../');
  }
}

if (!function_exists('resource_path')) {
  function resource_path(String $path): String
  {
    return PathHelpers::getInstance()->resources . '/' . $path;
  }
}

if (!function_exists('views_path')) {
  function views_path(String $path = ''): String
  {
    return PathHelpers::getInstance()->views;
  }
}

if (!function_exists('storage_path')) {
  function storage_path(String $path): String
  {
    return PathHelpers::getInstance()->storage . '/' . $path;
  }
}

if (!function_exists('public_path')) {
  function public_path(String $path = ''): String
  {
    return PathHelpers::getInstance()->public . '/' . $path;
  }
}