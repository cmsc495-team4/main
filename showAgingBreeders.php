<?php 
	session_start();
	//Check if user has an existing session, else send to login page.
	if (!isset($_SESSION['user_name'])) {
    		header('Location: login.php');
    		exit();
	}
?>

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
echo "<pre><p>diag info:</p>";
var_dump($finalData);
echo "</pre>";

function returnAgingBreeders ($ageMonths) {
    $returnArray=null;
require_once 'src/dbconfig.php';

	if (empty($ageMonths)) {
		$ageMonths = 6;
	}
    	try {
	        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


			$query = "CALL returnAgingBreeders(" . (int)$ageMonths . ")";

			$result = $pdo->query($query);
			$result->setFetchMode(PDO::FETCH_ASSOC);



			//call stored MySQL procedure to retrieve data
			//while ( $row= mysql_fetch_array( $query ))
			$i=0;
			
			while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {

				if (!empty($row)) {
			
					$returnArray[$i] = $row;
					$i++;
				
		
					// $returnArray[0] is pairID (int);
					// $returnArray[1] is male breeder tagNumber (int);
					// $returnArray[2] is female breeder tagNumber (int);
					// $returnArray[3] is the desiredStrain (string);
					// $returnArray[4] is the generation name of pair's offspring (string);
					// $returnArray[5] is the pair date (string/date);
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
