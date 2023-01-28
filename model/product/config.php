<?php

$server = "localhost";
$user = "simeon1993";
$pass = "spartacus1993";
$database = "simeon1993_database";

// connect to database
$conn = mysqli_connect($server, $user, $pass, $database);

// check connection
if (!$conn) {
	die("<script>alert('Connection Failed.')</script>");
}