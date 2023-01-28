<?php

include('config.php');

session_start();

if (!isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}

$id = $_GET['id'];
$query = mysqli_query($conn, "select * from `product` where productid='$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>

<head>
	<title>Edit</title>
</head>

<body>
<h2>Edit</h2>
<form method="POST" action="update.php?id=<?php echo $id; ?>">
	<label>Product Name:</label><input type="text" value="<?php echo $row['productname']; ?>" name="productname">
	<label>Product Price:</label><input type="text" value="<?php echo $row['productprice']; ?>" name="productprice">
	<input type="submit" name="submit">
	<a href="indexx.php">Back</a>
</form>
</body>

</html>