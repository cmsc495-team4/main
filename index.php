<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
?>
<html>
  <head>
  </head>
  <body>
    <center>
      <h1>Welcome - CMSC495</h1>
      <h3>Stuff goes here...</h3>
    </center>
    <p>&nbsp;</p>
    <p>Search for breeder pairs older than (months):</p>
 <form action="lib/getAgingBreeders.php" method="get"> 
 <input type="text" name="months" placeholder="6" /> 
 <input type="submit" name="submit" /> </form> 
    </p>
    <?php getDropDown("generation_name", "generations"); ?>
    <hr>
    <?php
		$testvar = checkLitterExists(9); 
		echo $testvar;  
    ?>
    
    <?php
 		addPups(10,4,"mouse","strain2", "2018-12-05") {
    ?>
  </body>
</html>
