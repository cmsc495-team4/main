<html>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//var_dump($GLOBALS);
// Check if the form is submitted 
if ( isset( $_REQUEST["submit"] ) ) { // retrieve the form data by using the element's name attributes value as key 
    $ageMonths = $_REQUEST["months"]; 
}
$returndata=array();


$finalData=returnAgingBreeders($ageMonths);
    //echo implode( ", ", $finalData );
if (is_array($finalData)){
echo '<h3>List of Aging Breeder Pairs</h3>'; 
echo "<table border=\"1\">";
echo "<tr><th>Pair ID</th><th>Male TagNumber</th><th>Female tagNumber</th><th>Desired Strain</th><th>Generation</th><th>Pair Date</th><th>Notes</th></tr>";

foreach ( $finalData as $tableRow) {
	echo "<tr>";
	foreach ((array)$tableRow as $columnVal) {
		echo "<td>" . htmlspecialchars($columnVal) . "</td>";
	}
echo "</tr>";
}
echo "</table>";
}
else {
    echo "No matches found!";
}

//echo "<pre><p>diag info:</p>";
//var_dump($finalData);
//echo "</pre>";

function returnAgingBreeders ($ageMonths) {
    $returnArray=null;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

	if (empty($ageMonths)) {
		$ageMonths = 6;
	}
    	try {
	        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

			//select all records with a breeder classification from the SQL view (combined_search) with a birth date > 6 months from now
			$query = "SELECT * FROM combined_search WHERE birth_date <= (now() - interval 6 month) AND classification='breeder'";

			$result = $pdo->query($query);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$i=0;
			
			while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {

				if (!empty($row)) {
			
					$returnArray[$i] = $row;
					$i++;
				}
				else {
					$returnArray=array("No Records Found");
				}
			}
		} catch (PDOException $e) {
            $returnArray=array("Error accessing database");
        }

	return $returnArray;
}

?>

</body>
</html>