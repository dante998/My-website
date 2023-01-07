<?php

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST'){
 // proccess data
  header("Location: /",true,301);
  exit();
  // return html
}

