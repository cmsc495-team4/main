<?php

//  Function: getDropDown()
//  Parameters required:  $fieldName and $tableName
//
// This function is to be inserted between the <select> tags of an HTML dropdown dialog
// Call this function with the arguments $fieldName (name of DB field for which you want a value)
//  and $tableName (name of DB table containing field)
//
// results of calling: getDropDown("generation_name", "generations") will be returned similar to:
// <option value="gen1">gen1</option>
// <option value="gen2">gen2</option>
// <option value="gen3">gen3</option>
// --where, for example "gen1" is the value contained in the "generation_name" field of the table "generations"
//
//  Your HTML dropdown code will look similar to this:
//  <select name="choose_generation">
//      getDropDown("generation_name", "generations");  <--wrapped in php tags
//  </select>


function getDropDown ($fieldName, $tableName) {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $returndata=array();
    $returnArray=null;
    
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$query = "SELECT " . $fieldName . " FROM " . $tableName . "";
		$result = $pdo->query($query);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$i=0;
		
		while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
			if (!empty($row)) {
		
				$returnArray[$i] = $row;
				$i++;
				$skipRest = "false";
			}
			else {
				echo "<option value=\"none\">No records avail</option>\n";
				$skipRest="true";
			}
		}
		
		if ($skipRest != "true"){
			foreach ($returnArray as $row) {
				foreach ($row as $key=>$val) {
					echo "testtest<option value=\"$val\">$val</option>\n";

				if ($key == $fieldName) {
					echo "<option value=\"$val\">$val</option>\n";
				}
				else {
					echo "<option value=\"none\">No records avail</option>\n";
				}
				}
			}
		}
			
}


function checkLitterExists ($litterID) {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    $litterExists = TRUE;
    
    	try {
	        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$query = "SELECT id FROM litters WHERE litterID = " . $litterID;
			$result = $pdo->query($query);
			$result->fetch(PDO::FETCH_ASSOC);

			if (!$result) {
				$litterExists = FALSE;
				}
	return $litterExists;
		} catch (PDOException $e) {
            $returnArray=array("Error accessing database");
        }

}

function addPups($litterID, $numberPups, $species, $strain, $birthDate) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$failCount = 0;

	$options = [
	  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
	  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
	  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
	];
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    
    $litterExists = checkLitterExists($litterID);
    
		if ($litterExists) {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
			
			$setup = $pdo->prepare("SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;");
			$setup->execute();	
			
			$query = $pdo->prepare("INSERT INTO `animals` (`litterID`, `species`, `strain`, `birth_date`) VALUES (?, ?, ?, ?)");
			
			for ($i=0; $i < $numberPups; $i++) {
				if (!$query->execute([$litterID, $species, $strain, $birthDate])) {
					$failCount++;
					}
				}
			if ($failCount > 0) {
				echo "Error inserting records!";
				}
			else {
				echo "Success - " . $numberPups . " new pups added to the database!";
				}
			} 
		else {
			echo "Error - Duplicate Litter ID";
			}
		
}
?>












