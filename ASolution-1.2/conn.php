<?php

//$host = "sql312.byethost5.com";
//$db_name = "b5_16374922_invoice_management";
//$username = "b5_16374922";
//$password = "807054";
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

//$host = "localhost";
//$db_name = "asolution";
//$username = "root";
//$password = "";
//
//try {
//	$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
//}
//
//catch(PDOException $exception){ //to handle connection error
//	echo "Connection error: " . $exception->getMessage();
//}




//$conn = @mysql_connect('localhost','root','');
//if (!$conn) {
//	die('Could not connect: ' . mysql_error());
//}
//mysql_select_db('asolution', $conn);

