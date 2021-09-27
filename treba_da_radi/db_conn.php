<?php  

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "aa";


//$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $uname, $password);
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/////////////////////////
$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}