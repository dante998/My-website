<?php

namespace services\db;

use Exception;
use PDO;

class Database {

	private static $dbInstance = null;

	private function __construct(){

	}

	private function __clone(){

	}

	public static function getInstance() {

		if ( self::$dbInstance == null  ) {

			try {
				self::$dbInstance = new PDO('mysql:host=127.0.0.1;dbname=mywebsite', 'root', 'root');
			} catch (Exception $e) {
				echo $e->getMessage();			
			}
		}
		return self::$dbInstance;
	}
}