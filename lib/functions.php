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

				if ($key == $fieldName) {
					echo "<option value=\"" . htmlspecialchars($val) . "\">" . htmlspecialchars($val) . "</option>\n";
				}
				else {
					echo "<option value=\"none\">No records avail</option>\n";
				}
				}
			}
		}
		
		$pdo=null;
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
        
		$pdo=null;
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
				echo "Success - " . htmlspecialchars($numberPups) . " new pups added to the database!";
				}
			} 
		else {
			echo "Error - Duplicate Litter ID";
			}
			
		$pdo=null;
}

function displayAnimalTable() {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$displayAll = TRUE;

	if ( isset( $_REQUEST["Filter"] ) ) { // retrieve the form data by using the element's name attributes value as key 
		$displayAll = FALSE;
    	$filterSpecies = $_REQUEST["species"]; 
    	$filterStrain = $_REQUEST["strain"]; 
    	$filterLitter = $_REQUEST["litterID"]; 
    	$filterBreeder = $_REQUEST["breederPair"]; 
    	$filterSpecies = $_REQUEST["species"]; 
    	$filterPI = $_REQUEST["investigator"]; 
    	$filterSpecies = $_REQUEST["species"]; 
    	$filterGeno = $_REQUEST["genotype"]; 
    	$filterClass = $_REQUEST["class"]; 
    	$filterTagNumber = $_REQUEST["tagNumber"]; 
	}

	$options = [
	  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
	  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
	  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
	];
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);

	echo "<div id=\"animal_table\">";
	echo "<style type=\"text/css\" scoped>";
	echo "table {border-collapse: collapse; border-spacing: 5px;}";
	echo "table, th, td {border: 1px solid black;}";
	echo "th {text-align: center; vertical-align: middle; background-color: #bbbbff; padding:10px}";
	//echo "tr:nth=child(even) {background-color: #ffffff;}";
	echo "tr:nth=child(odd)  {background-color: #cccccc;}";
	echo "td {text-align: center; vertical-align: middle;  padding: 4px}";
	echo "</style>";

	echo "<form>";
    echo "<table id=\"animals\">";
    echo "<tr><th>Select</th><th>ID</th><th>Investigator</th><th>Tag Number</th><th>Species</th><th>Class</th><th>Sex</th><th>Strain</th><th>Genotype</th><th>Litter ID</th><th>Parent Pair</th><th>Birth Date</th><th>Wean Date</th><th>Tag Date</th><th>Deceased</th><th>Transferred</th><tr>";
    
    if ($displayAll) {
    
    	$query1 = "SELECT * FROM `animals`";
		
		$result = $pdo->query($query1);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		$tableRow=0;
		
		while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
			if (!empty($row)) {
				$animalID = $row["animalID"];
				$species = $row["species"];
				$tagNumber = $row["tagNumber"];
				$sex = $row["sex"];
				$classification = $row["classification"];
				$strain = $row["strain"];
				$genotype = $row["genotype"];
				$birth_date = $row["birth_date"];
				$wean_date = $row["wean_date"];
				$tag_date = $row["tag_date"];
				$deceased = $row["deceased"];
				$transferred = $row["transferred"];
				
				if ($deceased == 1) {
					$strDeceased = "Yes";
				}
				else {
					$strDeceased = "No";
				}
				
				if ($transferred == 1) {
					$strTransferred = "Yes";
				}
				else {
					$strTransferred = "No";
				}

				$query2="SELECT `litterID`, `breedingPair` FROM litters WHERE animalID_pup=" . $animalID;
				$result2 = $pdo->query($query2);
				$result2->setFetchMode(PDO::FETCH_ASSOC);
				$row2 = $result2->fetch(PDO::FETCH_ASSOC);
				
				$litterID = $row2["litterID"];
				$parentPair = $row2["breedingPair"];
				
				
				$query3="SELECT responsible_PI FROM strains WHERE strain_name='" . $strain . "'";
				$result3 = $pdo->query($query3);
				$result3->setFetchMode(PDO::FETCH_ASSOC);
				$row3 = $result3->fetch(PDO::FETCH_ASSOC);
				
				$responsible_PI = $row3["responsible_PI"];
				
				$query4="SELECT first_name, last_name FROM user WHERE username='" . $responsible_PI . "'";
				$result4 = $pdo->query($query4);
				$result4->setFetchMode(PDO::FETCH_ASSOC);
				$row4 = $result4->fetch(PDO::FETCH_ASSOC);
				
				$firstName = $row4["first_name"];
				$lastName = $row4["last_name"];

				

				echo "<tr>";
				echo "<td><input type=\"radio\" name=\"rowselect\" value=\"" . htmlspecialchars($animalID) . "\"></td>";
				echo "<td>" . $animalID . "</td>"; 
				echo "<td>" . $lastName . ", " . $firstName . "</td>";
				echo "<td>" . $tagNumber . "</td>"; 
				echo "<td>" . $species . "</td>"; 
				echo "<td>" . $classification . "</td>"; 
				echo "<td>" . $sex . "</td>"; 
				echo "<td>" . $strain . "</td>"; 
				echo "<td>" . $genotype . "</td>"; 
				echo "<td>" . $litterID . "</td>"; 
				echo "<td>" . $parentPair . "</td>"; 
				echo "<td>" . $birth_date . "</td>"; 
				echo "<td>" . $wean_date . "</td>"; 
				echo "<td>" . $tag_date . "</td>"; 
				echo "<td>" . $strDeceased . "</td>"; 
				echo "<td>" . $strTransferred . "</td>"; 
				echo "</tr>";
				
				
			}
		}

    }
    
    
    
	echo "</table>";
	echo "</form>";
    $pdo=null;
   
}
?>












