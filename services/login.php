<?php

if (!$_SERVER['REQUEST_METHOD'] !== 'POST') {
  $name = $_POST['username'];
  $psw = $_POST['psw'];
  if ($name === 'nikolay' && $psw === 'nikolay'){
    include_once "../templates/login.html";
    exit();
  }
  else{
    echo ' you are entering wrong data';
  }
}
