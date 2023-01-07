<?php

$path = $_SERVER['REQUEST_URI'];
switch ($path) {
  case '/';
    include_once "./templates/home.html";
  break;
  case '/register';
    include_once "./templates/register.html";
    break;
  default:
    include_once "./templates/404.html";
    break;
}



$stop = 1;