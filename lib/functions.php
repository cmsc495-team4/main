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
                if (! in_array($val, $alreadyFound)) { // don't add duplicate values to the list
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

function getInvestigators()
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
        echo "<!-- *** dropdown box \"<option>\" values are auto-generated by code -->\n";
        echo "<option name=\"pi_name\" value=\"\" selected>- select -</option>\n";
        
        foreach ($returnArray as $row) {
            // foreach ($row as $key=>$val) {
            $name = $row['last_name'] . ", " . $row['first_name'];
            $username = $row['username'];
            echo "<option name=\"pi_name\" value=\"" . htmlspecialchars($username) . "\">" . htmlspecialchars($name) . "</option>\n";
            // }
        }
    }
    
    $pdo = null;
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
            $animalList = "WHERE species='" . $filterSpecies . "'";
        } else {
            $animalList = $animalList . " AND species='" . $filterSpecies . "'";
        }
    }
    
    if (! empty($_REQUEST["strain_name"])) {
        $displayAll = FALSE;
        
        $filterStrain = $_REQUEST["strain_name"];
        if (empty($animalList)) {
            $animalList = "WHERE strain='" . $filterStrain . "'";
        } else {
            $animalList = $animalList . " AND strain='" . $filterStrain . "'";
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
            $animalList = "WHERE birth_date=" . $filterBirthDate . "'";
        } else {
            $animalList = $animalList . " AND birth_date=" . $filterBirthDate . "'";
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
        }
          else {
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
        }
          else {
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
    echo "<tr>
    		<th>Select</th> <th>ID</th> <th>Investigator</th> <th>Tag Number</th> 
    		<th>Species</th> <th>Class</th> <th>Sex</th> <th>Strain</th> <th>Genotype</th> 
    		<th>Litter ID</th> <th>Parent Pair</th> <th>Birth Date</th> <th>Wean Date</th> 
    		<th>Tag Date</th> <th>Deceased</th> <th>Transferred</th> 
    	  </tr>\n";
    echo "</thead>
	<tbody>";
    
    if ($displayAll) {
        
        $query1 = "SELECT * FROM `combined_search`";
        
        $result = $pdo->query($query1);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $tableRow = 0;
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (! empty($row)) {
                $animalID = $row["animalID"];
                $tagNumber = $row["tagNumber"];
                $sex = $row["sex"];
                $classification = $row["classification"];
                $genotype = $row["genotype"];
                $birth_date = $row["birth_date"];
                $wean_date = $row["wean_date"];
                $tag_date = $row["tag_date"];
                $deceased = $row["deceased"];
                $transferred = $row["transferred"];

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
                
                $query3 = "SELECT first_name, last_name FROM user WHERE username='" . $responsible_PI . "'";
                $result3 = $pdo->query($query3);
                $result3->setFetchMode(PDO::FETCH_ASSOC);
                $row3 = $result3->fetch(PDO::FETCH_ASSOC);
                
                $firstName = $row3["first_name"];
                $lastName = $row3["last_name"];
                
                $query4 = "SELECT `strain_name`, `strain_species` FROM `strains` WHERE id_strain=" . $strain_ID;
                $result4 = $pdo->query($query4);
                $result4->setFetchMode(PDO::FETCH_ASSOC);
                $row4 = $result4->fetch(PDO::FETCH_ASSOC);
                
                $strain = $row4["strain_name"];
                $species = $row4["strain_species"];
                
                $query5 = "SELECT litterID, breedingPair FROM litters WHERE animalID_pup=" . $animalID;
                $result5 = $pdo->query($query5);
                $result5->setFetchMode(PDO::FETCH_ASSOC);
                $row5 = $result5->fetch(PDO::FETCH_ASSOC);
                
                $litterID = $row5["litterID"];
                $parentPair = $row5["breedingPair"];

                echo "<tr>\n";
                echo "<td><input type=\"radio\" name=\"rowselect\" value=\"" . htmlspecialchars($animalID) . "\"></td>\n";
                echo "<td>" . $animalID . "</td>\n";
                echo "<td>" . $lastName . ", " . $firstName . "</td>\n";
                echo "<td>" . $tagNumber . "</td>\n";
                echo "<td>" . $species . "</td>\n";
                echo "<td>" . $classification . "</td>\n";
                echo "<td>" . $sex . "</td>\n";
                echo "<td>" . $strain . "</td>\n";
                echo "<td>" . $genotype . "</td\n>";
                echo "<td>" . $litterID . "</td>\n";
                echo "<td>" . $parentPair . "</td>\n";
                echo "<td>" . $birth_date . "</td>\n";
                echo "<td>" . $wean_date . "</td>\n";
                echo "<td>" . $tag_date . "</td>\n";
                echo "<td>" . $strDeceased . "</td>\n";
                echo "<td>" . $strTransferred . "</td>\n";
                echo "</tr>\n";
            }
        }
    } else {
        
        $query1 = "SELECT * FROM `combined_search` " . $animalList;
        
        echo "\n<br>SQL Query Debug --> <strong>" . $query1 . "</strong>\n<br><br>";
        //echo var_dump($_POST);
        //echo var_dump($_REQUEST);

        $result = $pdo->query($query1);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $tableRow = 0;
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if (! empty($row)) {
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
                $parentPair = $row["breedingPair"];
                $litterID = $row["litterID"];

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
                
                $query2 = "SELECT PI_username, strain_ID FROM PI_assigned_animals WHERE PI_animalID=" . $animalID;
                $result2 = $pdo->query($query2);
                $result2->setFetchMode(PDO::FETCH_ASSOC);
                $row2 = $result2->fetch(PDO::FETCH_ASSOC);
                
                $responsible_PI = $row2["PI_username"];
                $strain_ID = $row2["strain_ID"];
                
                $query3 = "SELECT first_name, last_name FROM user WHERE username='" . $responsible_PI . "'";
                $result3 = $pdo->query($query3);
                $result3->setFetchMode(PDO::FETCH_ASSOC);
                $row3 = $result3->fetch(PDO::FETCH_ASSOC);
                
                $firstName = $row3["first_name"];
                $lastName = $row3["last_name"];
                
                $query4 = "SELECT strain_name, strain_species FROM strains WHERE id_strain=" . $strain_ID;
                $result4 = $pdo->query($query4);
                $result4->setFetchMode(PDO::FETCH_ASSOC);
                $row4 = $result4->fetch(PDO::FETCH_ASSOC);
                
                $strain = $row4["first_name"];
                $species = $row4["strain_species"];
                
                
                echo "<tr>\n";
                echo "<td><input type=\"radio\" name=\"rowselect\" value=\"" . htmlspecialchars($animalID) . "\"></td>\n";
                echo "<td>" . $animalID . "</td>\n";
                echo "<td>" . $lastName . ", " . $firstName . "</td>\n";
                echo "<td>" . $tagNumber . "</td>\n";
                echo "<td>" . $species . "</td>\n";
                echo "<td>" . $classification . "</td>\n";
                echo "<td>" . $sex . "</td>\n";
                echo "<td>" . $strain . "</td>\n";
                echo "<td>" . $genotype . "</td\n>";
                echo "<td>" . $litterID . "</td>\n";
                echo "<td>" . $parentPair . "</td>\n";
                echo "<td>" . $birth_date . "</td>\n";
                echo "<td>" . $wean_date . "</td>\n";
                echo "<td>" . $tag_date . "</td>\n";
                echo "<td>" . $strDeceased . "</td>\n";
                echo "<td>" . $strTransferred . "</td>\n";
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
