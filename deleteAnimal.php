<?php
//recieves animal id from selected value from mainpage. AJAX method used to send data
	$selectedValue = (int)$_POST['selectedValue'];

  require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
	echo $selectedValue;
	//deleteAnimal($selectedValue);

 ?>
