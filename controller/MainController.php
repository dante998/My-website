<?php

namespace controller;

use model\Product;
use model\User;
use PDO;
use services\db\Database;

class MainController {

	public static function home() {
		return './views/home.html';
	}

	public static function login($method = 'GET', $data = []) {
		if ($method === 'GET') {
			return '/var/www/reworked_my-website/views/login.html';
		}
		if ($method === 'POST') {
			$password = $data['psw'] ?? '';
			$email = $data['email'] ?? '';
			if (empty($data) || !$email || !$password) {
				return NOTFOUND404;
			}
			// check if user exist
			$query = sprintf("SELECT * FROM users WHERE email='%s'", $email);
			$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
			if ($result) {
				// this is the hashed password
				$dataBaseStoredPassword = $result['password'];
				if (password_verify($password, $dataBaseStoredPassword)) {
					setcookie("user", "John Smith", time() + (86400 * 30), "/qw");
					session_destroy();
					$_SESSION['user_id'] = $result['id'];
					header('Location: /userhome');
					exit();


					// Redirect the user to the protected page
//					header('Location: login');
//					exit;


					return '/var/www/reworked_my-website/views/home_login.html';
				}
				return 'wrong password';
			}


		}
	}

	public static function register($method = 'GET', $data = []) {
		if ($method === 'GET') {
			return '/var/www/reworked_my-website/views/register.html';
		}
		if ($method === 'POST') {
			$email = $data['email'] ?? '';
			$name = $data['username'] ?? '';
			$password = $data['psw'] ?? '';
			$query = sprintf("SELECT * FROM users WHERE email='%s'", $email);
			$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
			if (!$result) {
				$newUser = new User($name, $email, $password);
				$newUser->insertIntoDataBase();
				header('Location: login');
				exit();
			}
		}


		//		return NOTFOUND404;
	}

	public static function product($method = 'GET' ,$data = []) {
		if ($method === 'GET'){
			return '/var/www/reworked_my-website/views/addProduct.html';
		}
		$productName = $data['productName'] ?? '';
		$productPrice = $data['productPrice'] ?? '';
		$query = sprintf("SELECT * FROM products WHERE productName='%s'",
			$productName);
		$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			$newUser = new Product($productName, $productPrice);
			$newUser->addProduct();
			header('Location: /');
		}
	}

	public static function items() {
		session_start();
		if ($_COOKIE['user']) {
			return '/var/www/reworked_my-website/views/checkMyItems.html';
		}
		else {
			return NOTFOUND404;
		}
	}

	public static function userHome() {
		return '/var/www/reworked_my-website/views/home_login.html';

	}

	public static function logout() {
		session_destroy();
		unset($_COOKIE['user']);
		header("Location: /");
		exit();
	}

	public static function listAll() {
		$query = sprintf("SELECT * FROM products");
		$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
		$a = 1;
		$_GET['products'] = $result;
		return  '/var/www/reworked_my-website/views/listItems.html';
	}


}