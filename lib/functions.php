<?php

// Function: getDropDown()
// Parameters required: $fieldName and $tableName
//
// This function is to be inserted between the <select> tags of an HTML dropdown dialog
// Call this function with the arguments $fieldName (name of DB field for which you want a value)
// and $tableName (name of DB table containing field)
//
// results of calling: getDropDown("generation_name", "generations") will be returned similar to:
// <option value="gen1">gen1</option>
// <option value="gen2">gen2</option>
// <option value="gen3">gen3</option>
// --where, for example "gen1" is the value contained in the "generation_name" field of the table "generations"
//
// Your HTML dropdown code will look similar to this:
// <select name="choose_generation">
// getDropDown("generation_name", "generations"); <--wrapped in php tags
// </select>
function getDropDown($fieldName, $tableName, $previousValue)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $returndata = array();
    $returnArray = null;
    $extra = "";

    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $query = "SELECT DISTINCT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " ASC";
    //echo "\n--> " . $query . "\n";
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);

    $i = 0;
    $j = 0;
    $alreadyFound = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if (! empty($row)) {

            $returnArray[$i] = $row;
            $i ++;
            $skipRest = "false";
        } else {
            echo "<option value=\"none\">No records avail</option>\n";
            $skipRest = "true";
        }
    }

    if ($skipRest != "true") {

        if (! empty($previousValue)) {
            echo "<option name=\"" . $fieldName . "\"value=\"\" >- select -</option>\n";
        } else {
            echo "<!-- *** dropdown box \"<option>\" values are auto-generated by code -->\n";
            echo "<option name=\"" . $fieldName . "\"value=\"\" selected>- select -</option>\n";
        }
        foreach ($returnArray as $row) {
            foreach ($row as $key => $val) {
                if ($val == $previousValue) {
                    $extra = "selected";
                }
                if (! in_array($val, $alreadyFound) && ($val != "")) { // don't add duplicate or blank values to the list
                    if ($key == $fieldName) {
                        echo "<option name=\"" . $fieldName . "\" value=\"" . htmlspecialchars($val) . "\" " . $extra . ">" . htmlspecialchars($val) . "</option>\n";
                    } else {
                        echo "<option value=\"none\">No records avail</option>\n";
                    }
                }
                $alreadyFound[$j] = $val;
                $j ++;
                $extra = "";
            }
        }
        // echo "<option value=\"0000\" selected>- select -</option>\n";
    }

    $pdo = null;
}

function getInvestigators($last_pi_name)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $returndata = array();
    $returnArray = null;

    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $query = "SELECT DISTINCT * FROM user WHERE user_role='Investigator' ORDER BY last_name ASC";
    $result = $pdo->query($query);
    // var_dump($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);

    $i = 0;

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if (! empty($row)) {

            $returnArray[$i] = $row;
            $i ++;
            $skipRest = "false";
        } else {
            echo "<option value=\"pi_name\" selected>No Investigators</option>\n";
            $skipRest = "true";
        }
    }

    if ($skipRest != "true") {
        if (! empty($last_pi_name)) {
            echo "<option name=\"pi_name\" value=\"\">- select -</option>\n";
        } else {
            echo "<!-- *** dropdown box \"<option>\" values are auto-generated by code -->\n";
            echo "<option name=\"pi_name\" value=\"\" selected>- select -</option>\n";
        }

        foreach ($returnArray as $row) {
            // foreach ($row as $key=>$val) {
            $name = $row['last_name'] . ", " . $row['first_name'];
            $username = $row['username'];
            if ($username == $last_pi_name) {
                echo "<option name=\"pi_name\" value=\"" . htmlspecialchars($username) . "\" selected>" . htmlspecialchars($name) . "</option>\n";
            } else {
                echo "<option name=\"pi_name\" value=\"" . htmlspecialchars($username) . "\">" . htmlspecialchars($name) . "</option>\n";
            }
        }
    }

    $pdo = null;
}

function newLitterIncrement(){
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  try {
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $sql = 'SELECT MAX(litterID) FROM litters';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    $temp = $q->fetch();
  } catch (PDOException $e) {

  }

  return $temp['MAX(litterID)'] + 1;
}

function checkLitterExists($litterID)
{
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

        if (! $result) {
            $litterExists = FALSE;
        }
        return $litterExists;
    } catch (PDOException $e) {
        $returnArray = array(
            "Error accessing database"
        );
    }

    $pdo = null;
}

function addPups($litterID, $numberPups, $species, $strain, $birthDate)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $failCount = 0;

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // make the default fetch be an associative array
    ];
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

    $litterExists = checkLitterExists($litterID);

    if ($litterExists) {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);

        $setup = $pdo->prepare("SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;");
        $setup->execute();

        $query = $pdo->prepare("INSERT INTO `animals` (`litterID`, `species`, `strain`, `birth_date`) VALUES (?, ?, ?, ?)");

        for ($i = 0; $i < $numberPups; $i ++) {
            if (! $query->execute([
                $litterID,
                $species,
                $strain,
                $birthDate
            ])) {
                $failCount ++;
            }
        }
        if ($failCount > 0) {
            echo "Error inserting records!";
        } else {
            echo "Success - " . htmlspecialchars($numberPups) . " new pups added to the database!";
        }
    } else {
        echo "Error - Duplicate Litter ID";
    }

    $pdo = null;
}

function addBreedPair($strain, $date, $male, $female, $notes){
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // make the default fetch be an associative array
    ];
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
	
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
	//prepare and call stored procedure
	$query = $pdo->prepare("CALL addBreedPair(?, ?, ?, ?, ?, @p_id)");
	//Bind all in parameters. OUT parameter does not need binding
	$query->bindParam(1, $male, PDO::PARAM_INT, 11);
	$query->bindParam(2, $female, PDO::PARAM_INT, 11);
	$query->bindParam(3, $strain, PDO::PARAM_STR, 45);
	$query->bindParam(4, $date, PDO::PARAM_STR, 11);
	$query->bindParam(5, $notes, PDO::PARAM_STR, 512);
	$return = $query->execute()->fetchAll();
	
	if($return){
		//clear prior query buffer
		//$query->fetchAll();
		//gets stored procedure's output
		$sprocOutput = $pdo->query("SELECT @p_id;")->fetchAll();
		echo "Successfully added new breeding pair. New pair #: " . htmlspecialchars($sprocOutput['@p_id']);
	}
	else{
		echo "Addition Failed!!!";
	}
	
	$pdo = null;
}

function getAnimals()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (isset($_REQUEST["Filter"])) { // retrieve the form data by using the element's name attributes value as key
        $displayAll = FALSE;
        $filterPI = $_REQUEST["pi_name"];
        $filterBreeder = $_REQUEST["breedingPair"];
        $filterSpecies = $_REQUEST["species_name"];
        $filterPair = $_REQUEST["strain_name"];
        $filterTagNumber = $_REQUEST["tagNumber"];
        $filterLitter = $_REQUEST["litterID"];
        $filterDOB = $_REQUEST["birth_date"];
        $filterBreeder = $_REQUEST["breeder"];
        $filterPup = $_REQUEST["pup"];
        $filterWeanling = $_REQUEST["weanling"];
    }
}

function displayAnimalTable()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $animalList = "";
    $litterFilter = "";
    $displayAll = TRUE;

    if (isset($_REQUEST["clear"])) {
        $_POST = array();
        $_REQUEST = array();
    }

    // echo "before\n";
    if (isset($_REQUEST["filter"])) { // retrieve the form data by using the element's name attributes value as key
        $displayAll = FALSE;
        // echo $displayAll;
        if (! empty($_REQUEST["pi_name"])) {
            $filterPI = $_REQUEST["pi_name"];
            $piFilter = "WHERE username='" . $filterPI . "'";
        }
    }

    if (! empty($_REQUEST["pairID"])) {
        $displayAll = FALSE;

        $filterbreedingPair = $_REQUEST["pairID"];
        if (empty($animalList)) {
            $animalList = "WHERE breedingPair=" . $filterbreedingPair;
        } else {
            $animalList = $animalList . " AND breedingPair=" . $filterbreedingPair;
        }
    }

    if (! empty($_REQUEST["litterID"])) {
        $displayAll = FALSE;

        $filterLitterID = $_REQUEST["litterID"];
        if (empty($animalList)) {
            $animalList = "WHERE litterID=" . $filterLitterID;
        } else {
            $animalList = $animalList . " AND litterID=" . $filterLitterID;
        }
    }

    if (! empty($_REQUEST["species_name"])) {
        $displayAll = FALSE;

        $filterSpecies = $_REQUEST["species_name"];
        if (empty($animalList)) {
            $animalList = "WHERE species_name='" . $filterSpecies . "'";
        } else {
            $animalList = $animalList . " AND species_name='" . $filterSpecies . "'";
        }
    }

    if (! empty($_REQUEST["strain_name"])) {
        $displayAll = FALSE;

        $filterStrain = $_REQUEST["strain_name"];
        if (empty($animalList)) {
            $animalList = "WHERE strain_name='" . $filterStrain . "'";
        } else {
            $animalList = $animalList . " AND strain_name='" . $filterStrain . "'";
        }
    }

    if (! empty($_REQUEST["genotype_name"])) {
        $displayAll = FALSE;

        $filterGenotype = $_REQUEST["genotype_name"];
        if (empty($animalList)) {
            $animalList = "WHERE genotype='" . $filterGenotype . "'";
        } else {
            $animalList = $animalList . " AND genotype='" . $filterGenotype . "'";
        }
    }

    if (! empty($_REQUEST["tagNumber"])) {
        $displayAll = FALSE;

        $filterTagNumber = $_REQUEST["tagNumber"];
        if (empty($animalList)) {
            $animalList = "WHERE tagNumber=" . $filterTagNumber;
        } else {
            $animalList = $animalList . " AND tagNumber=" . $filterTagNumber;
        }
    }

    if (! empty($_REQUEST["birth_date"])) {
        $displayAll = FALSE;

        $filterBirthDate = $_REQUEST["birth_date"];
        echo "----->> dobvar: [" . $filterBirthDate . "]\n";
        if (empty($animalList)) {
            $animalList = "WHERE birth_date='" . $filterBirthDate . "'";
        } else {
            $animalList = $animalList . " AND birth_date='" . $filterBirthDate . "'";
        }
    }

    if (! empty($_REQUEST["breeder"])) {
        $filterBreeder = "breeder";
        if (empty($animalList)) {
            $animalList = "WHERE (classification='" . $filterBreeder . "'";
        } else {
            $animalList = $animalList . " AND (classification='" . $filterBreeder . "'";
        }

        if ((empty($_REQUEST["pup"])) && (empty($_REQUEST["weanling"]))) {
            $animalList = $animalList . ")";
        }
    }

    if (! empty($_REQUEST["pup"])) {
        $filterPup = "pup";
        if (empty($animalList)) {
            $animalList = "WHERE (classification='" . $filterPup . "'";
        } elseif (empty($_REQUEST["breeder"])) {
            $animalList = $animalList . " AND (classification='" . $filterPup . "'";
        } else {
            $animalList = $animalList . " OR classification='" . $filterPup . "'";
        }

        if (empty($_REQUEST["weanling"])) {
            $animalList = $animalList . ")";
        }
    }

    if (! empty($_REQUEST["weanling"])) {
        $filterWeanling = "weanling";
        if (empty($animalList)) {
            $animalList = "WHERE (classification='" . $filterWeanling . "')";
        } elseif ((empty($_REQUEST["breeder"])) && (empty($_REQUEST["pup"]))) {
            $animalList = $animalList . " AND (classification='" . $filterWeanling . "')";
        } else {
            $animalList = $animalList . " OR classification='" . $filterWeanling . "')";
        }
    }

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // make the default fetch be an associative array
    ];
    require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);

    echo "<!-- *** NOTE *** This HTML table and contents are auto-generated by code -->\n";

    echo "<div id=\"animalTable\" class=\"maintable\">\n";
    echo "<form>\n";
    echo "<table id=\"maintable\" class=\"display compact\">\n";
    echo "<thead>";
    echo "<tr class=\"animalList\">
    		<th class=\"animals\">Select</th> <th class=\"animals\">ID</th> <th class=\"animals\">Investigator</th> <th class=\"animals\">Tag<br>Number</th> 
    		<th class=\"animals\">Species</th> <th class=\"animals\">Class</th> <th class=\"animals\">Sex</th> <th class=\"animals\">Strain</th> <th class=\"animals\">Genotype</th> 
    		<th class=\"animals\">Litter<br>ID</th> <th class=\"animals\">Parent<br>Pair</th> <th class=\"animals\">Birth<br>Date</th> <th class=\"animals\">Wean<br>Date</th> 
    		<th class=\"animals\">Tag<br>Date</th> <th class=\"animals\">Deceased</th> <th class=\"animals\">Transferred</th> 
    	  </tr>\n";
    echo "</thead>
	<tbody>";

    if ($displayAll) {

        $query1 = "SELECT * FROM `filtered_return`";

        $result = $pdo->query($query1);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $tableRow = 0;

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (! empty($row)) {
                $animalID = $row["animalID"];
                $tagNumber = $row["tagNumber"];
                $sex = $row["sex"];
                $strain = $row["strain_name"];
                $species = $row["species_name"];
                $classification = $row["classification"];
                $genotype = $row["genotype"];
                $birth_date = $row["birth_date"];
                $wean_date = $row["wean_date"];
                $tag_date = $row["tag_date"];
                $deceased = $row["deceased"];
                $transferred = $row["transferred"];
                $comments = $row["comments"];
                
                if ($deceased == 1) {
                    $strDeceased = "Yes";
                } else {
                    $strDeceased = "No";
                }

                if ($transferred == 1) {
                    $strTransferred = "Yes";
                } else {
                    $strTransferred = "No";
                }

                $query2 = "SELECT PI_username, PI_strain_ID FROM PI_assigned_animals WHERE PI_animalID=" . $animalID;
                $result2 = $pdo->query($query2);
                $result2->setFetchMode(PDO::FETCH_ASSOC);
                $row2 = $result2->fetch(PDO::FETCH_ASSOC);

                $responsible_PI = $row2["PI_username"];
                $strain_ID = $row2["PI_strain_ID"];

                if (! empty($responsible_PI)) {
                    $query3 = "SELECT first_name, last_name FROM user WHERE username='" . $responsible_PI . "'";
                    $result3 = $pdo->query($query3);
                    $result3->setFetchMode(PDO::FETCH_ASSOC);
                    $row3 = $result3->fetch(PDO::FETCH_ASSOC);

                    $firstName = $row3["first_name"];
                    $lastName = $row3["last_name"] . ", ";
                } else {
                    $lastName = "Unassigned";
                    $firstName = "";
                }

                $query5 = "SELECT litterID, breedingPair FROM litters WHERE animalID_pup=" . $animalID;
                $result5 = $pdo->query($query5);
                $result5->setFetchMode(PDO::FETCH_ASSOC);
                $row5 = $result5->fetch(PDO::FETCH_ASSOC);

                $litterID = $row5["litterID"];
                $parentPair = $row5["breedingPair"];

                echo "<tr class=\"animalList\" title=\"Animal Notes: " . $comments . "\">\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\"><input type=\"radio\" name=\"rowselect\" value=\"" . htmlspecialchars($animalID) . "\"></td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $animalID . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: left;\">" . $lastName . $firstName . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $tagNumber . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $species . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $classification . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $sex . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strain . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $genotype . "</td\n>";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $litterID . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $parentPair . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $birth_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $wean_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $tag_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strDeceased . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strTransferred . "</td>\n";
                echo "</tr>\n";
            }
        }
    } else {

        $query1 = "SELECT * FROM `filtered_return` " . $animalList;

        echo "\n<br><font style=\"color: red;\">SQL Query Debug --> <strong>" . $query1 . "</strong></font>\n<br><br>";
        // echo var_dump($_POST);
        // echo var_dump($_REQUEST);

        $result = $pdo->query($query1);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $tableRow = 0;

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (! empty($row)) {
                $animalID = $row["animalID"];
                $tagNumber = $row["tagNumber"];
                $sex = $row["sex"];
                $strain = $row["strain_name"];
                $species = $row["species_name"];
                $classification = $row["classification"];
                $genotype = $row["genotype"];
                $birth_date = $row["birth_date"];
                $wean_date = $row["wean_date"];
                $tag_date = $row["tag_date"];
                $deceased = $row["deceased"];
                $transferred = $row["transferred"];
                $parentPair = $row["breedingPair"];
                $litterID = $row["litterID"];
                $comments = $row["comments"];

                if ($deceased == 1) {
                    $strDeceased = "Yes";
                } else {
                    $strDeceased = "No";
                }

                if ($transferred == 1) {
                    $strTransferred = "Yes";
                } else {
                    $strTransferred = "No";
                }

                $query2 = "SELECT PI_username, PI_strain_ID FROM PI_assigned_animals WHERE PI_animalID=" . $animalID;
                $result2 = $pdo->query($query2);
                $result2->setFetchMode(PDO::FETCH_ASSOC);
                $row2 = $result2->fetch(PDO::FETCH_ASSOC);

                $responsible_PI = $row2["PI_username"];
                $strain_ID = $row2["PI_strain_ID"];
                // echo "--> " . $filterPI . ": " . $responsible_PI . "\n\n";
                if ((! empty($filterPI)) && ($responsible_PI != $filterPI)) {
                    continue;
                }

                if (! empty($responsible_PI)) {
                    $query3 = "SELECT first_name, last_name FROM user WHERE username='" . $responsible_PI . "'";
                    $result3 = $pdo->query($query3);
                    $result3->setFetchMode(PDO::FETCH_ASSOC);
                    $row3 = $result3->fetch(PDO::FETCH_ASSOC);

                    $firstName = $row3["first_name"];
                    $lastName = $row3["last_name"] . ", ";
                } else {
                    $lastName = "Unassigned";
                    $firstName = "";
                }

                $query5 = "SELECT litterID, breedingPair FROM litters WHERE animalID_pup=" . $animalID;
                $result5 = $pdo->query($query5);
                $result5->setFetchMode(PDO::FETCH_ASSOC);
                $row5 = $result5->fetch(PDO::FETCH_ASSOC);

                $litterID = $row5["litterID"];
                $parentPair = $row5["breedingPair"];

                echo "<tr class=\"animalList\" title=\"Animal Notes: " . $comments . "\">\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\"><input type=\"radio\" name=\"rowselect\" value=\"" . htmlspecialchars($animalID) . "\"></td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $animalID . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: left;\">" . $lastName . $firstName . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $tagNumber . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $species . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $classification . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $sex . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strain . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $genotype . "</td\n>";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $litterID . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $parentPair . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $birth_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $wean_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $tag_date . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strDeceased . "</td>\n";
                echo "<td class=\"animalList\" style=\"text-align: center;\">" . $strTransferred . "</td>\n";
                echo "</tr>\n";
            }
        }
    }

    echo "</tbody></table>\n";
    echo "</form>\n";
    echo "</div>";
    $pdo = null;
}
?>
