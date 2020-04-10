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

		$params = array(":title"=> $title,
				":size"=> $size,
				":amount"=> $amount,
				":category"=> $category,
				":price"=> $price,
				":brand"=> $brand);
                
		$stmt->execute($params);
	}
	catch(Exception $e){
		echo $e->getMessage();
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
			function doValidations(form){
				let isValid = true;
				if(!verifyTitle(form)){
					isValid = false;
				}
				if(!verifySize(form)){
					isValid = false;
				}
				if(!verifyAmount(form)){
					isValid = false;
				}
				if(!verifyCategory(form)){
					isValid = false;
				}
				if(!verifyPrice(form)){
					isValid = false;
				}
				if(!verifyBrand(form)){
					isValid = false;
				}
				return isValid;
			}
			function verifyTitle(form){
				let te = document.getElementById("title_error);
				if(form.title.value.trim().length  == 0){
					te.innerText = "Please enter a title";
					return false;
				}
				else{
					te.innerText = "";
					return true;
				}
			function verifySize(form){
				let se = document.getElementById("size_error);
				if(form.size.value.trim().length  == 0){
					se.innerText = "Please enter a size";
					return false;
				}
				else{
					se.innerText = "";
					return true;
				}
			function verifyAmount(form){
				let ae = document.getElementById("amount_error);
				if(form.amount.value.trim().length  == 0){
					ae.innerText = "Please enter an amount";
					return false;
				}
				else{
					ae.innerText = "";
					return true;
				}
			function verifyCategory(form){
				let ce = document.getElementById("category_error);
				if(form.category.value.trim().length  == 0){
					ce.innerText = "Please enter a category";
					return false;
				}
				else{
					ce.innerText = "";
					return true;
				}
			function verifyPrice(form){
				let pe = document.getElementById("price_error);
				if(form.price.value.trim().length  == 0){
					pe.innerText = "Please enter a price";
					return false;
				}
				else{
					pe.innerText = "";
					return true;
				}
			function verifyBrand(form){
				let be = document.getElementById("brand_error);
				if(form.brand.value.trim().length  == 0){
					be.innerText = "Please enter a brand";
					return false;
				}
				else{
					be.innerText = "";
					return true;
				}
			</script>
		</head>
		<body onload="findFormsOnLoad();">
			<form name="regform" id="myForm" method="POST"
					onsubmit="return doValidations(this)">
			<div>
				<label for="title">Title: </label><br>
				<input type="title" id="title" name="title" placeholder="Enter title"/>
				<span id="title_error"></span>
			</div>
			<div>
				<label for="size">Size: </label><br>
				<input type="size" id="size" name="size" placeholder="Enter size"/>
				<span id = "size_error"></span>
			</div>
			<div>
				<label for="amount">Amount: </label><br>
				<input type="amount" id="amount" name="amount" placeholder="Enter amount"/>
				<span id="amount_error"></span>
			</div>
			<div>
				<label for="category">Category: </label><br>
				<input type="category" id="category" name="category" placeholder = "Enter category"/>
				<span id="category_error"></span>
			</div>
			<div>
				<label for="price">Price: </label><br>
				<input type="price" id="price" name="price" placeholder = "Enter price"/>
				<span id="price_error"></span>
			</div>
			<div>
				<label for="brand">Brand: </label><br>
				<input type="brand" id="brand" name="brand" placeholder = "Enter brand"/>
				<span id="brand_error"></span>
			</div>
			<div>
				<div>&nbsp;</div>
				<input type="submit" onsubmit="return doValidations(this)" value="List Item"/>
			</div>
		</form>
		<?php if(isset($msg)):?>
			<span><?php echo $msg;?></span>
		<?php endif;?>

	</body>
</html>