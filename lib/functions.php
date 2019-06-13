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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getDropDown ($fieldName, $tableName) {
    $returndata=array();
    $returnArray=null;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    
    	try {
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

                    if ($key == $fieldName) {
                        echo "<option value=\"$val\">$val</option>\n";
                    }
                    else {
                        echo "<option value=\"none\">No records avail</option>\n";
                    }
                    }
                }
			}
			
		} catch (PDOException $e) {
            $returnArray=array("Error accessing database");
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
			$result->setFetchMode(PDO::FETCH_ASSOC);

			if ($result->num_rows == 0) {
				$litterExists = FALSE;
				}
	return $litterExists;
		} catch (PDOException $e) {
            $returnArray=array("Error accessing database");
        }

}

function addPups ($litterID, $numberPups, $species, $strain, $birthDate) {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    
	try {
		if (checkLitterExists($litterID)) {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$query = "INSERT INTO \'animals\' (\'litterID\', \'species\', \'strain\', \]'birth_date\') VALUES ";

			for ($i=0; $i < $numberPups; $i++) {
				$query = $query . "(" . $litterID . ", " . $species . ", " . $strain . ", " . $birthdate . ")";

				if ($i < $numberPups-1) {
					$query = $query . ",";
				}
				else {
					$query = $query . ";";
				}
			}
			
			$result = $pdo->query($query);
			$result->setFetchMode(PDO::FETCH_ASSOC);

		}
		else {
			echo "Error - Duplicate Litter ID";
		}
	} catch (PDOException $e) {
        	$returnArray=array("Error accessing database");
    	}

}
?>












