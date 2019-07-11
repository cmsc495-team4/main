<?php 
	session_start();
	//Check if user has an existing session, else send to login page.
	if (!isset($_SESSION['user_name'])) {
    		header('Location: login.php');
    		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>RITA - Add Animal</title>
	<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
			
	
	
</head>

<header>
	
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$message = "";
		
		if(isset($_POST['add'])){
			if(empty($_POST['pi_name']) || empty($_POST['species_name']) || empty($_POST['sex']) || empty($_POST['dob']) || empty($_POST['strain_name'])) {
				$message = "All fields with * required";
			}
			else{
				$vals = array(
				"pi" => $_POST['pi_name'],
				"species" => $_POST['species_name'],
				"classification" => $_POST['classification'],
				"sex" => $_POST['sex'],
				"tagDate" => (!empty($_POST['tagDate']) ? $_POST['tagDate'] : NULL),
				"birthDate" => (!empty($_POST['dob']) ? $_POST['dob'] : NULL),
				"weanDate" => (!empty($_POST['weanDate']) ? $_POST['weanDate'] : NULL),
				"genotype" => (!empty($_POST['genotype']) ? $_POST['genotype'] : NULL),
				"litter" => (!empty($_POST['litter']) ? $_POST['litter'] : NULL),
				"location" => (!empty($_POST['location']) ? $_POST['location'] : NULL),
				"strain_ID" => (!empty($_POST['strain_name']) ? $_POST['strain_name'] : NULL),
				"tagNum" => (!empty($_POST['tagNum']) ? $_POST['tagNum'] : NULL),
				"deceased" => (isset($_POST['deceased']) ? true : false),
				"transfer" => (isset($_POST['transfer']) ? true : false),
				"notes" => $_POST['commentBox']
				);
				
				addNewAnimal($vals);	
			}
			$_POST = null;
		}
	?>
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		//strains dropdown
		$("[name='pi_name']").change(function(){
			var pi_name = $(this).val();
			var fieldTable = ['strain_name', 'strains, PI_authorized_strains', ''];
			var conditions = ['authPI_username', '\'' + pi_name + '\'', 'authPI_strain_ID', 'id_strain'];
			$.ajax({
				type: "POST",
				url: "/lib/ajaxDropdown.php",
				data: {fieldTable: fieldTable, conditions: conditions},
				cache: false,
				success: function(strains){
					$("[name='strain_name']").html(strains);
				}
			});	
		});
		
		});
	</script>
	  <form style="float:left" action="http://495team4.com/mainpage.php" method="POST">
  <button class="button" type="submit" name="home" style="margin-left:16px; margin-top:16px"> Home </button>
</form>

		<div class="logo">
			<img class="ritalogo" src="img/ritalogo-1.png" height="97"
				width="360">
			<h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
		</div>

</header>

<body class="mainbody">
&nbsp;<p></p>
<h3 class="subtitle">Add New Animal</h3>

<style>
.fixed-bottom-wrapper {
	position: fixed;
	bottom: 0;
	width: 100%;
	z-index: -1;
	padding-bottom: 8px;
}

.fixed-bottom-wrapper img {
	display: table;
	opacity: 0.33;
	position: relative;
	margin: auto;
	width: 315px;
	height: 216px;
	z-index: -1;
}
</style>


	<form style="padding:8px" action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
	<fieldset>
	<legend> Add Animal </legend>
	<div>
		<?php 
			addUserButton();
			if(isset($message)){
				echo '<label class="text-danger" style="color:red">' . $message . '</label>';
			}
		?>
		<div style="text-align: center">
			<input type="radio" id="pup" name="classification" value="pup" checked>
					<label for="pup">Pup</label>
					<input type="radio" id="weanling" name="classification" value="weanling">
					<label for="weanling">Weanling</label>
					<input type="radio" id="breeder" name="classification" value="breeder">
					<label for="breeder">Breeder</label>
		</div>
		<center>
		<table>
			<tr>
				<td></td>	
			</tr>
			<tr>
				<td>PI:*</td>
				<td>
					<select name="pi_name">
						<?php getInvestigators(""); ?>
					</select>
				</td>
				<td>Species:*</td>
				<td>
					<select name="species_name">
						<?php getDropDown("species_name", "animals", $species_name); ?>
					</select>
				</td>
				<td>Strain:* ([Re]select PI first)*</td>
				<td>
					<select name="strain_name">
						<option>Select PI</option> <!-- ajax created based on selected PI -->
					</select>
				</td>
			</tr>
			<tr>
				
				<td>DOB:*</td>
				<td>
					<input type="date" name="dob" placeholder="mm/dd/yyyy">
				</td>
				
				<td>Wean Date:</td>
				<td>
					<input type="date" name="weanDate" placeholder="mm/dd/yyyy">
				</td>
				
				<td>Location:</td>
				<td>
					<select name="location">
						<?php getDropDown("location_name", "location", ""); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tag #:</td>
				<td>
					<input type="text" name="tagNum" placeholder="Tag #">
				</td>
				<td>Tag Date:</td>
				<td>
					<input type="date" name="tagDate" placeholder="Tag Date">
				</td>
				<td>Sex:*</td>
				<td>
					<select name="sex">
						<option value="">-select-</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Genotype</td>
				<td>
					<select name="genotype">
						<?php getDropDown("genotype_name", "genotypes", "") ?>
					</select>
				</td>
				<td><label hidden>Litter ID</label></td> <!-- litter for future use -->
				<td>
					<select name="litter" hidden>
						<?php getDropDown("litterID", "litters", "") ?>
					</select>
				</td>
				<td>
					<input type="checkbox" name="transfer">
					<label for="transfer">Transferred</label>
					<input type="checkbox" name="deceased" value="true">
					<label for="deceased">Deceased</label>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table class="table3">
			<tr>
				<td>Comments:</td>
				<td>
					<textarea id="commentBox" name="commentBox" rows="5" cols="33"></textarea>
				</td>
		</table>
	</div>
	<div class="buttonDiv">
		<button class="button" type="submit" name="add">Add Animal</button>
	</div>
	</center>
	</form>
	
					<div class="fixed-bottom-wrapper">
		<img align="center" class="rodents" src="img/rodentsv3.png"> </br>
		<center> <br>
		&emsp; © 2019, CMSC495 Team #4</br></center>

	</div>
	</div>
	</br>&nbsp;
	</br>

</body>
</html>
