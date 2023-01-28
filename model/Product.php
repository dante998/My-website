<?php

namespace model;

use services\db\Database;

class Product {

	protected string $productName;

	protected int $productPrice;

	/**
	 * @return string
	 */
	public function getProductName(): string {
		return $this->productName;
	}

	/**
	 * @return int
	 */
	public function getProductPrice(): int {
		return $this->productPrice;
	}



	public function addProduct() : void {
		$con = Database::getInstance();
		$query = 'insert into products(productName, productPrice ) values (
        :productName,
        :productPrice
        )';
		$stmt = $con->prepare($query);
		$stmt->bindParam(':productName',$this->productName);
		$stmt->bindParam(':productPrice',$this->productPrice);
		$stmt->execute();

	}

	public function __construct(string $productName, int $productPrice) {
		$this->productName = $productName;
		$this->productPrice = $productPrice;
	}





}