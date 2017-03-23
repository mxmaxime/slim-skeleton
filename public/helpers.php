<?php

function public_path () {
  return realpath('./');
}

function root_path () {
  return realpath('../');
}
