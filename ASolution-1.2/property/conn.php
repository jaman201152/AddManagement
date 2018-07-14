<?php

$host = "localhost";
$db_name = "asolution";
$username = "root";
$password = "";

try {
	$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

catch(PDOException $exception){ //to handle connection error
	echo "Connection error: " . $exception->getMessage();
}

//$conn = @mysql_connect('localhost','root','');
//if (!$conn) {
//	die('Could not connect: ' . mysql_error());
//}
//mysql_select_db('asolution', $conn);

