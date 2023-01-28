<?php

$id = $_GET['id'];
include('config.php');
mysqli_query($conn, "delete from `product` where productid='$id'");
header('location:indexx.php');