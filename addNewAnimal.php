<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
	
	
</head>

<header>
	<h1>Add New Animal Form</h1>
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$message = "";
		
		if(isset($_POST['add'])){
			//var_dump($_POST);
			/*if(empty(empty($_POST['species_name']) ||$_POST['sex']) || empty($_POST['dob'])) {
				$message = "Must enter a species, sex, DOB";
			}
			else{*/
				$vals = array(
				"species" => $_POST['species_name'],
				"classification" => $_POST['classification'],
				"sex" => $_POST['sex'],
				"tagDate" => (!empty($_POST['tagDate']) ? $_POST['tagDate'] : NULL),
				"birthDate" => (!empty($_POST['dob']) ? $_POST['dob'] : NULL),
				"weanDate" => (!empty($_POST['weanDate']) ? $_POST['weanDate'] : NULL),
				"genotype" => (!empty($_POST['genotype']) ? $_POST['genotype'] : NULL),
				"litter" => (!empty($_POST['litter']) ? $_POST['litter'] : NULL),
				"location" => (!empty($_POST['location']) ? $_POST['location'] : NULL),
				"strain_ID" => (!empty($_POST['strain']) ? $_POST['strain'] : NULL),
				"tagNum" => (!empty($_POST['tagNum']) ? $_POST['tagNum'] : NULL),
				"deceased" => (isset($_POST['deceased']) ? true : false),
				"transfer" => (isset($_POST['transfer']) ? true : false),
				"notes" => $_POST['commentBox']
				);
				
				addNewAnimal($vals);	
			/*}
			$_POST = null;*/
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
	
</header>

<body>
	<form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
	<div>
		<?php 
			if(isset($message)){
				echo '<label class="text-danger" style="color:red">' . $message . '</label>';
			}
		?>
		<div style="text-align: center">
			<input type="radio" id="pup" name="classification" value="pup" checked>
					<label for="huey">Pup</label>
					<input type="radio" id="weanling" name="classification" value="weanling">
					<label for="huey">Weanling</label>
					<input type="radio" id="breeder" name="classification" value="breeder">
					<label for="huey">Breeder</label>
		</div>
		<table class="table1">
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
				<td>Strain:</td>
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
				<td>Sex:</td>
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
				<td>Litter ID</td>
				<td>
					<select name="litter">
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
		<button class="button" type="submit" name="add">Add</button>
	</div>
	</form>
</body>
</html>
