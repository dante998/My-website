<?php

session_start();

use controller\MainController;

$requestPath = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
const NOTFOUND404 = '/var/www/reworked_my-website/views/404.html';
$template = NOTFOUND404;

switch ($requestMethod) {
	case 'GET':
		switch ($requestPath) {
			case '/' :
				$template = MainController::home();
				break;
			case '/login' :
				$template = MainController::login();
				break;
			case '/items' :
				$template = MainController::items();
				break;
			case '/register' :
				$template = MainController::register();
			case '/userhome' :
				$template = MainController::userHome();


		}
		break;
	case 'POST':
		switch ($requestPath) {
			case '/login' :
				$template = MainController::login($requestMethod, $_POST);
				break;
			case '/register' :
				$template = MainController::register($requestMethod, $_POST);
				break;
			case '/logout' :
				 MainController::logout();
		}
}
require_once $template;
