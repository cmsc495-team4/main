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
	<title>RITA - Add Breeding Pair</title>
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
	
	<div class="main-body">
	<center>
	<div class="logo">
		<img align="center" class="ritalogo" src="img/ritalogo-1.png"
			height="97" width="360">
		</br></br>
		<h2 class="maintitle">Add Breeding Pair Form
		<br style = "line-height:100px;"></br></div>
</head>

<header>
<br style = "line-height:30px;"></br>

	
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$message = "";
		
		if(isset($_POST['add'])){
			//var_dump($_POST);
			if(empty(empty($_POST['strain_name']) ||$_POST['setupDate']) || empty($_POST['maleTag']) || empty($_POST['femaleTag'])) {
				$message = "All fields required";
			}
			else{
				$strain = $_POST['strain_name'];
				$date = $_POST['setupDate'];
				$male = getIdByTag($_POST['maleTag']);
				$female = getIdByTag($_POST['femaleTag']);
				$notes = $_POST['commentBox'];
				$addedID = addBreedPair($strain, $date, $male, $female, $notes);	
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
		
		//Male tag # dropdown after species selected (based off species and PI). conditions are in pairs for ie WHERE animalID=PI_animalID AND etc
		$("[name='species_name']").change(function(){
			var pi_name = $("[name='pi_name']").val();
			var species_name = $(this).val();
			var fieldTable = ['tagNumber', 'animals, PI_assigned_animals', ''];
			var conditions = ['animalID', 'PI_animalID', 'PI_username', '\'' + pi_name + '\'', 'species_name', '\'' + species_name + '\'',
			'classification', '\'breeder\'', 'sex', '\'Male\''];
			$.ajax({
				type: "POST",
				url: "/lib/ajaxDropdown.php",
				data: {fieldTable: fieldTable, conditions: conditions},
				cache: false,
				success: function(mTag){
					$("[name='maleTag']").html(mTag);
				}
			});	
		});
		
		//Female tag # dropdown after species selected (based off species and PI)
		$("[name='species_name']").change(function(){
			var pi_name = $("[name='pi_name']").val();
			var species_name = $(this).val();
			var fieldTable = ['tagNumber', 'animals, PI_assigned_animals', ''];
			var conditions = ['animalID', 'PI_animalID', 'PI_username', '\'' + pi_name + '\'', 'species_name', '\'' + species_name + '\'',
			'classification', '\'breeder\'', 'sex', '\'Female\''];
			$.ajax({
				type: "POST",
				url: "/lib/ajaxDropdown.php",
				data: {fieldTable: fieldTable, conditions: conditions},
				cache: false,
				success: function(fTag){
					$("[name='femaleTag']").html(fTag);
				}
			});	
		});
		});
	</script>
	
</header>

<body>
	<form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
	<fieldset>
		<legend>Add Breeding Pair</legend>
	<div>
		<?php 
			addUserButton();
			if(isset($message)){
				echo '<label class="text-danger" style="color:red">' . $message . '</label>';
			}
		?>
		<table class="table1">
			<tr>
				<td>PI:</td>
				<td>
					<select name="pi_name">
						<?php getInvestigators(""); ?>
					</select>
				</td>
				<td>Species:</td>
				<td>
					<select name="species_name">
						<?php getDropDown("species_name", "animals", $species_name); ?>
					</select>
				</td>
				<td>Strain:</td>
				<td>
					<select name="strain_name">
						<option>Select PI</option> <!-- ajax created based on selected PI -->
					</select>
				</td>
			</tr>
			<tr>
				
				<td>Setup Date:</td>
				<td>
					<input type="date" name="setupDate" placeholder="mm/dd/yyyy">
				</td>
				
				<td>Male Tag #:</td>
				<td>
					<select name="maleTag">
						<option value=''>Male Tag#</option>
					</select>
				</td>
				
				<td>Female Tag #:</td>
				<td>
					<select name="femaleTag">
						<option value='';>Female Tag#</option>
					</select>
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
		<button class="button" type="submit" name="add">Add</button>
	</div>
	</form>
		</fieldset>
	<br style = “line-height:5500;”>
		<footer>
		<img align="left" class="mouselogo" src="img/mouse-1.png" height="117"
			width="87">

		
	</footer>
	<br>&emsp; © 2019, CMSC495 Team #4
	</br>
</body>
</html>
