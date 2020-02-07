<html>
	<head>
		<title>My Project - Register</title>
	</head>
	<body>
		<!-- This is how you comment -->
		<form method="POST">
			<label for = "email">Email: </label>
			<input type = "email" id = "email" name = "email" placeholder = "Enter Email"/>
			<label for "pass"> Password: </label>
			<input type = "password" id = "pass" name = "password" placeholder = "Enter password"/>
			<label for = "confirm">Confirm Password: </label>
			<input type = "password" id = "conf" name = "confirm" placeholder = "Confirm password"/>
			<input type="submit" value="Enter"/>
		</form>
	</body>
</html>
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//if(!empty($_REQUEST)){
	//echo "Request:<pre>" . var_export($_REQUEST, true) . "</pre>";
//}
//if(!empty($_GET)){
	//echo "GET:<pre>" . var_export($_GET, true) . "</pre>";
//}
//if(!empty($_POST)){
	//echo "POST:<pre>" . var_export($_POST, true) . "</pre>";

if(  	   isset($_POST['email']) 
	&& isset($_POST['password']) 
    	&& isset($_POST['confirm'])
	){
	$pass = $_POST['password'];
	$conf = $_POST['confirm'];
	if($pass == $conf){
		echo "Registering User";
		exit();
	}
	else{
		echo "Incorrect";
	}
	
	$pass = password_hash($pass, PASSWORD_BCRYPT);
	echo "<br>$pass<br>";

	require("config.php");
	$connection_string = "mysql:host = $dbhost;dbname = $dbdatabase; charset - utf8mb4";
	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("INSERT INTO 'USERS3'
				(email, password) VALUES
				(:Email, :password)");
		$email = $_POST['email'];
		$params = array(":email"=> $email,
		":password"=> $pass);
		$stmt->execute($params);
		echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
	}
	catch(Exceprion $e) {
		echo $e->getMessage();
		exit();
	}
}
?>
