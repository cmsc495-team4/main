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
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
		//updates strain list based on selected PI
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
	
</head>

<header>
	<h1>Update Animal Form</h1>
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$message = "";
		$change_id = "";
		//for selecting animal to update
		if(isset($_POST['getAnimal'])){
			$change_id = $_POST['animalID'];
			displayAnimalTable();
			$message = "All updates will affect animal with ID (not tag#): " . $change_id;
		}
		//for updating selected animal
		if(isset($_POST['update'])){
			//check that a tag number was selected before attempting update
			if(empty($_POST['change_id'])){
				$message = "Select animals ID before updating";
			}else{
				$message = "Select ID to update" ;
				updateAnimal();
			}
		}
	?>
	

	
<div style="height: auto; width: auto;">
			<form class="header-form" action="<?php $_SERVER['REQUEST_URI']?>"
				method="POST">
				<fieldset>
				<table style="margin: auto">
					<legend>Filter Results</legend>
						<tr>
							<td>Animal ID:</td>
							<td><select name="animalID"> 
          	  <?php getDropDown("animalID", "animals", $change_id); ?>
			</select></td>

							<td class="filter-button"><button class="action" type="submit"
									name="getAnimal" value="submitted">Get Current Data</button></td>
						</tr>
					</table>
				</fieldset>
			</form>
		</div>
		
	</header>

<body>
	<form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
	<div>
		<?php 
			addUserButton();
			if(isset($message)){
				echo '<label class="text-danger" style="color:red; display:block; text-align:center; font-size:1.5em;">' . $message . '</label>';
			}
		?>
		<input type="hidden" name="change_id" value="<?php echo $change_id ?>">
		<div style="text-align: center">
			<input type="radio" id="pup" name="classification" value="pup">
				<label for="pup">Pup</label>
			<input type="radio" id="weanling" name="classification" value="weanling">
				<label for="weanling">Weanling</label>
			<input type="radio" id="breeder" name="classification" value="breeder">
				<label for="breeder">Breeder</label>
		</div>
		<table class="table1">
			<tr>
				<td></td>	
			</tr>
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
				<td>Strain: ([Re]select PI first)</td>
				<td>
					<select name="strain_name">
						<option value = "">Select PI</option> <!-- ajax created based on selected PI -->
					</select>
				</td>
			</tr>
			<tr>
				
				<td>DOB:</td>
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
					<input type="checkbox" name="deceased">
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
		<button class="button" type="submit" name="update">Update</button>
	</div>
	</form>
</body>
</html>
