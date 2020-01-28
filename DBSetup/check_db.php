<?php
ini_set('display_error', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
echo "DBUser: " \ $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$database;charset=utf8mb4";

try{
	$db = newPDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE 'Test' (
			'id' int auto_increment not null,
			'username' varchar(30) not null unique,
			'pin' int default 0,
			PRIMARY KEY ('id')
			) CHARACTER SET utf8 COLLATE utf8_general_ci"
		);
	$stmt->execute();
	echo var_export($stmt->errorInfo(), true);
}
catch(Exception $e){
	echo $e->getMessage();
	exit("It didn't work:);
}
?>
