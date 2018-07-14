<?php

	// exmple 

	include "wordtonumber.class.php";
	
	$wordtonumber = new WordToNumber();

	//echo $wordtonumber->convertToNumbers("one hundred fifty six thousand"); // should return 156000
	//echo "<br>";
	//echo $wordtonumber->convertToNumbers("sixty six thousand five hundred thirty four"); // should return 66534
	//echo "<br>";
	//echo $wordtonumber->convertToNumbers("forty five million"); // should return 45000000
	
        echo $wordtonumber->convertNumberToWord();
?>

