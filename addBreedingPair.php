<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
	
	
</head>

<header>
	<h1>Add Breeder Pair Form</h1>
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
		
		$last_pi_name = "";
		$species_name = "";
		$strain_name = "";
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
			var fieldTable = ['animalID', 'animals, PI_assigned_animals', ''];
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
			var fieldTable = ['animalID', 'animals, PI_assigned_animals', ''];
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
	<div>
		<table class="table1">
			<tr>
				<td>PI:</td>
				<td>
					<select name="pi_name">
						<?php getInvestigators($last_pi_name); ?>
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
				<td>Pair #:</td>
				<td>
					<input type="text" name="pairNum" placeholder="Pair #">
				</td>
				<td>Setup Date:</td>
				<td>
					<input type="text" name="setupDate" placeholder="mm/dd/yyyy">
				</td>
				<td>Generation:</td>
				<td>
					<input type="text" name="generation" placeholder="Generation">
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table class="table2">
			<tr>
				<td>Male Tag #:</td>
				<td>
					<select name="maleTag">
						<option>Male Tag#</option>
					</select>
				</td>
				<td>Female Tag #:</td>
				<td>
					<select name="femaleTag">
						<option>Female Tag#</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Male Strain:</td>
				<td>
					<input type="text" name="maleStrain" placeholder="Male Strain">
				</td>
				<td>Female Strain:</td>
				<td>
					<input type="text" name="femaleStrain" placeholder="Female Strain">
				</td>
			</tr>
			<tr>
				<td>Male DOB:</td>
				<td>
					<input type="text" name="maleDOB" placeholder="mm/dd/yyyy">
				</td>
				<td>Female DOB:</td>
				<td>
					<input type="text" name="femaleDOB" placeholder="mm/dd/yyyy">
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
</body>
</html>
