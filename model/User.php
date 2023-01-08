<?php

namespace model;

use services\db\Database;

class User {

	protected string $name;

	protected string $email;

	protected string $password;

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}


	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}


	private function hashPassword($password): string {
		return $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	}

	public function insertIntoDataBase() : void {
		$con = Database::getInstance();
		$query = 'insert into users(name, email, password) values (
        :name,
        :email,
        :password
        )';
		$stmt = $con->prepare($query);
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':email',$this->email);
		$stmt->bindParam(':password',$this->password);
		$stmt->execute();

	}

//	public static function create(string $name, string $email, string $password): User {
//		self::$user = new self($name, $email, $password);
//		return self::$user;
//	}

	public function __construct(string $name, string $email, string $password) {
		$this->name = $name;
		$this->email = $email;
		$this->password = $this->hashPassword($password);
	}

}