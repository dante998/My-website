<?php
namespace routes;
use controller\MainController;

$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
define("NOTFOUND404", "./views/404.html");


$template = './views/404.html';
if ($method === 'GET') {
	switch ($path) {
		case '/';
			$template = MainController::home();
			break;
		case '/register';
			$template  = './views/register.html';
			break;
	}

}
elseif ($method === 'POST') {
	switch ($path) {
		case '/login';
			$template = MainController::login($_POST);
			break;
		case '/register';
			$template = MainController::register($_POST,$method);
			break;
	}
}

return include_once $template;

