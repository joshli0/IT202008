\<?php
ini_set('display_error', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
echo $connection_string;
try{
	$db = new PDO($connection_string, $dbuser, $dbpass);
	echo "should have connected";
	$stmt = $db->prepare("CREATE TABLE `Test` (
			`id` int auto_increment not null,
			`username` varchar(30) not null unique,
			`pin` int default 0,
			PRIMARY KEY (`id`)
			) CHARACTER SET utf8 COLLATE utf8_general_ci"
		);
	$stmt->execute();
	$stmt = $db->prepare("INSERT INTO `TestUsers`
		(username, pin) VALUES
		(:username, :pin)");
	$stmt->bindValue(":username", 'Josh');
	$stmt->bindValue(":pin", 1369);
	//echo var_export($stmt->errorInfo(), true);
	$stmt = $db->prepare("SELECT id, username
				FROM `TestUsers`");
	$r = $stmt->execute(array(":username"=>'Josh',
				  ":id"=>1369));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<pre>" . var_export($r, true) . "</pre>";
	echo "<pre>" . var_export($results, true) . 
	"</pre>";
	
	$stmt = $db->prepare("Delete from `TestUsers`
			    Where id = :id");
	$r = $stmt->execute(array(":id"=> 1369);

	echo "<pre>" . var_export($r, true) . "</pre>";
	echo "<pre>" . var_export($stmt->errorInfo(), true)
	"<pre>";


}
catch(Exception $e){
	echo $e->getMessage();
	exit("It didn't work");
}
?>
