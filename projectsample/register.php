<html>
	<head>
		<title>My Project - Register</title>
		<script>
			function doValidations(form){
				let isValid = true;
				if(!verifyEmail(form) || !verifyPasswords(form)){
					isValid = false;
				}
				return isValid;
			}
			function verifyEmail(form){
				let ee = document.getElementById("email error");
				if(form.email.value.trim().length == 0){
					ee.innerText = "Please enter an email address";
					return false
				}
				else{
					ee.InnerText = "";
					return true;
				}
			}
			myFunction(1);
			function findFormsOnLoad(){
				let myForm = document.forms.regform;
				let mySameForm = document.getElementById("myForm");
				console.log("Form by name", myForm);
				console.log("Form by id", mySameForm);
			}
			function verifyPasswords(form){
				if(form.password.value.length == 0 || form.confirm.value.length == 0)){
					alert("You must enter a password and confirmation password");
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body onload="findFormsOnLoad();">
		<!-- This is how you comment -->
		<form name="regform" id="myForm" method="POST"
					onsubmit="return verifyPasswords(this) && verifyEmail(this)">
			<div>
			<label for="email">Email: </label>
			<input type="email" id="email" name="email" placeholder="Enter Email"/>
			<span id = "email_error"></span>
			</div>
			<div>
			<label for="pass">Password: </label>
			<input type="password" id="pass" name="password" placeholder="Enter password"/>
			</div>
			<div>
			<label for="conf">Confirm Password: </label>
			<input type="password" id="conf" name="confirm" placeholder = "Confirm password"/>
			<span id = "password_error"></span>;
			</div>
			<div>
			<input type="submit" value="Register"/>
			</div>
		</form>
	</body>
</html>
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(	   isset($_POST['email']) 
	&& isset($_POST['password'])
	&& isset($_POST['confirm'])
	){
	$pass = $_POST['password'];
	$conf = $_POST['confirm'];
	if($pass == $conf){
		echo "All good, 'registering user'";
	}
	else{
		echo "What's wrong with you? Learn to type";
		exit();
	}
	//let's hash it
	$pass = password_hash($pass, PASSWORD_BCRYPT);
	echo "<br>$pass<br>";
	//it's hashed
	require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	try {
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("INSERT INTO `Users3`
                        (email, password) VALUES
                        (:email, :password)");
		$email = $_POST['email'];
        $params = array(":email"=> $email, 
					":password"=> $pass);
        $stmt->execute($params);
        echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
	}
	catch(Exception $e){
		echo $e->getMessage();
		exit();
	}
}
?>