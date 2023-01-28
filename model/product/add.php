<?php

include('config.php');

$productname = $_POST['productname'];
$productprice = $_POST['productprice'];

mysqli_query($conn, "INSERT INTO `product` (productname,productprice) VALUES ('$productname','$productprice')");

header('location:indexx.php');
