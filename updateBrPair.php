<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
	
	
</head>

<header>
	<h1>Update Breeder Pair Form</h1>
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$message = "";
		$prID = "";
		if(isset($_POST['add'])){
			//var_dump($_POST);
			if(empty($_POST['prNum'])) {
				$message = "Must select a Bredding Pair # to update";
			}
			else{
				updateBreedPair();
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
			var fieldTable = ['strain_name', 'strains, pi_authorized_strains', ''];
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
			var fieldTable = ['animalID', 'animals, pi_assigned_animals', ''];
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
			var fieldTable = ['animalID', 'animals, pi_assigned_animals', ''];
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
	<div>
		<?php 
			if(isset($message)){
				echo '<label class="text-danger" style="color:red">' . $message . '</label>';
			}
		?>
		<table class="tableID" style="margin:auto">
			<tr style=" background:gray">
				<td>Pair#:</td>
					<td><select name="prNum"> 
          	  <?php getDropDown("pairID", "breeding_pairs", $prID); ?>
			</select>
			</tr>
		</table>
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
						<option value="">Select PI</option> <!-- ajax created based on selected PI -->
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
		<button class="button" type="submit" name="add">Update</button>
	</div>
	</form>
</body>
</html>