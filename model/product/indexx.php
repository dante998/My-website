<?php

include('config.php');
session_start();

if (!isset($_SESSION['username'])) {
	header("Location: './views/home.html'");
	exit();
}

$products = mysqli_query($conn, "SELECT * FROM `product`");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ecommerce platform</title>
</head>

<body>
<div>
	<?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
	<a href="logout.php">Logout</a>
</div>
<hr />
<div>
	<form method="POST" action="add.php">
		<label>Product Name:</label><input type="text" name="productname">
		<label>Product Price:</label><input type="text" name="productprice">
		<input type="submit" name="add">
	</form>
</div>
<br>
<div>
	<table border="1">
		<thead>
		<th>Product Name</th>
		<th>Product Price</th>
		<th></th>
		</thead>
		<tbody>
		<?php while ($product = mysqli_fetch_array($products)) : ?>
			<tr>
				<td><?php echo $product['productname']; ?></td>
				<td><?php echo $product['productprice']; ?></td>
				<td>
					<a href="edit.php?id=<?php echo $product['productid']; ?>">Edit</a>
					<a href="delete.php?id=<?php echo $product['productid']; ?>">Delete</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>
</body>

</html>