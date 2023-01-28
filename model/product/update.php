<?php

include('config.php');
$id=$_GET['id'];

$productname=$_POST['productname'];
$productprice=$_POST['productprice'];

mysqli_query($conn,"update `product` set productname='$productname', productprice='$productprice' where productid='$id'");
header('location:indexx.php');