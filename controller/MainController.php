<?php

namespace controller;

use model\Product;
use model\User;
use PDO;
use services\db\Database;

class MainController {

	public static function home() {
		$_POST['data']= 'eheheheh';
		return './views/home.html';
	}

	public static function register($data, $method) {
		$name = $data['username'] ?? '';
		$password = $data['psw'] ?? '';
		$email = $data['email'] ?? '';
//		if (empty($data) || !$user || !$password) {
//			return NOTFOUND404;
//		}
		$query = sprintf("SELECT * FROM users WHERE email='%s'", $email);
		$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			$newUser = new User($name, $email, $password);
			$newUser->insertIntoDataBase();
			return './views/successfullyRegister.html';

		}
	}

	public static function add($data) {
		$productName = $data['productName'] ?? '';
		$productPrice = $data['productPrice'] ?? '';

		$query = sprintf("SELECT * FROM products WHERE productName='%s'", $productName);
		$result = Database::getInstance()->query($query)->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			$newUser = new Product($productName, $productPrice);
			$newUser->addProduct();
			return './views/successfullyAddProduct.html';

		}
	}


	public static function login($data) {
		// here the variables from the post request....
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
				return './views/login.html';
			}
			return 'wrong password';
		}


		//		$con = Database::getInstance();
		//
		//		$query = $con->query("select username,password from users where username = \"$user\"")
		//			->fetch(PDO::FETCH_ASSOC);
		//		if ($query['username'] === $user && $query['password'] === $password) {
		//			echo ' heeeeeeyyy';
		//		}
		//		else {
		//			echo ' false;;;.';
		//		}

	}


}