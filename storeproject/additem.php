<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['title']) && isset($_POST['size']) && isset($_POST['amount']) 
&& isset($_POST['category']) && isset($_POST['price']) && isset($_POST['brand'])){
	$msg = "Item listed";
	require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try {
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("INSERT INTO `Items`
						(title, size, amount, category, price, brand) VALUES
						(:title, :size, :amount, :category, :price, :brand)");
		$title = $_POST['title'];
		$size = $_POST['size'];
		$amount = $_POST['amount'];
		$category = $_POST['category'];
		$price = $_POST['price'];
		$brand = $_POST['brand'];

		$params = array(":title" => $title,
				":size" => $size,
				":amount" => $amount,
				":category" => $category,
				":price" => $price,
				":brand" => $brand);
		$stmt-> execute($params);
	}
	catch(Exception $e){
		echo $e-> getMessage();
		exit();
	}
}
?>
<html>
	<head>
		<title>My Project - List Items</title>
		<style>
		body{
			background-color: white;
			color: black;
		}
		</style>
		<script>