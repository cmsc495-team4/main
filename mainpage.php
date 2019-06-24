
<?php
session_start();

 if (!isset($_SESSION['user_name'])){
	 header('Location: login.php');
	exit();
 } 

if (isset($_POST['pi_name'])) {
    $last_pi_name = $_POST['pi_name'];
} else {
    $last_pi_name = "";
}

if (isset($_POST['species_name'])) {
    $species_name = $_POST['species_name'];
} else {
    $species_name = "";
}

if (isset($_POST['strain_name'])) {
    $strain_name = $_POST['strain_name'];
} else {
    $strain_name = "";
}

if (isset($_POST['pairID'])) {
    $breedingPair = $_POST['pairID'];
} else {
    $breedingPair = "";
}

if (isset($_POST['tagNumber'])) {
    $tagNumber = $_POST['tagNumber'];
} else {
    $tagNumber = "";
}

if (isset($_POST['litterID'])) {
    $litterID = $_POST['litterID'];
} else {
    $litterID = "";
}

if (isset($_POST['genotype_name'])) {
    $genotype = $_POST['genotype_name'];
} else {
    $genotype = "";
}

if (isset($_POST['birth_date'])) {
    $dob = " value=" . "\"" . $_POST['birth_date'] . "\"";
} else {
    $dob = " placeholder=\"mm/dd/yyyy\"";
}

if (isset($_POST['filter'])) {
    if ($_POST['breeder'] == "on") {
        $breederChecked = "checked";
    } else {
        $breederChecked = "";
    }

    if ($_POST['weanling'] == "on") {
        $weanlingChecked = "checked";
    } else {
        $weanlingChecked = "";
    }

    if ($_POST['pup'] == "on") {
        $pupChecked = "checked";
    } else {
        $pupChecked = "";
    }
} else {
    $breederChecked = "checked";
    $weanlingChecked = "checked";
    $pupChecked = "checked";
}

if (isset($_REQUEST["clear"])) {
    $_POST = array();
    $_REQUEST = array();
    $breederChecked = "checked";
    $weanlingChecked = "checked";
    $pupChecked = "checked";
    $dob = " placeholder=\"mm/dd/yyyy\"";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8"/>
<title>RITA - Main Page</title>
<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.css" />
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.dataTables.css" />
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.css" />
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.css" />
		<link rel="stylesheet" type="text/css"
			href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.css" />

		<script type="text/javascript"
			src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.js"></script>
		<script type="text/javascript"
			src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.js"></script>

</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
?>
<body style="padding:4px;">

<header style="padding:4px;">
<div class="logo">
	<img class="ritalogo" src="img/ritalogo-1.png" height="97" width="360">
		<h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
		<div class="dropdown">
			<button class="dropbtn">User &#9660</button>
			<div class="dropdown-content">
				<?php
                    if ($_SESSION['role'] == "Admin")
                        echo '<a href="register.php">Create User</a>';
                    /* add other admin tasks here */
                ?>
				<a href="logout.php">Logout</a>
			</div>
		</div>

</div>
<div style="height:auto; width:auto;">
	<form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
		<fieldset>
			<legend>Filter Results</legend>
			<table>
				<tr>
					<td>PI:</td>
					<td><select name="pi_name">
        		<?php getInvestigators($last_pi_name); ?>
            </select></td>
					<td>Species:</td>
					<td><select name="species_name">
              <?php getDropDown("species_name", "animals", $species_name); ?>
            </select></td>
					<td>Strain:</td>
					<td><select name="strain_name">
              <?php getDropDown("strain_name", "strains", $strain_name); ?>
            </select></td>
					<td>Genotype:</td>
					<td><select name="genotype_name">
          	  <?php getDropDown("genotype_name", "genotypes", $genotype); ?>
			</select></td>

					<td>
						<!-- <input type="hidden" name="breeder" value="0"> --> <input
						type="checkbox" name="breeder" <?php echo $breederChecked; ?>>Breeders
					
					
					</td>

					<td>
						<!-- <input type="hidden" name="weanling" value="0" > --> <input
						type="checkbox" name="weanling" <?php echo $weanlingChecked; ?>>Weanlings
					
					
					</td>

					<td>
						<!-- <input type="hidden" name="pup" value="0" > --> <input
						type="checkbox" name="pup" <?php echo $pupChecked; ?>>Pups/Unclassified
					
					
					</td>


				</tr>
				<tr>
					<td>Pair:</td>
					<td><select name="pairID">
          	  <?php getDropDown("pairID", "breeding_pairs", $breedingPair); ?>
			</select></td>
					<td>Tag#:</td>
					<td><select name="tagNumber"> 
          	  <?php getDropDown("tagNumber", "animals", $tagNumber); ?>
			</select></td>
					<td>Litter ID:</td>
					<td><select name="litterID">
          	  <?php getDropDown("litterID", "litters", $litterID); ?>
			</select></td>

					<td>Date of Birth:</td>
					<td><input type="date" name="birth_date" <?php echo $dob; ?>></td>


					<td class="filter-button"><button class="action" type="submit"
							name="filter" value="submitted">Apply Filter</button></td>

					<td class="filter-button"><button class="action" type="submit"
							name="clear" value="submitted">Clear Filters</button></td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>
</header>

	<script>
$(document).ready( function () {
    $('#maintable').DataTable({
    		responsive: true
	});
} );


</script>
<?php displayAnimalTable() ?>


<script>
    
    function selectRow(){

        var radios = document.getElementsByName("rowselect");
        for( var i = 0; i < radios.length; i++ )
        {
            radios[i].onclick = function()
            {
                // remove class from the other rows
                
                var element = document.getElementById("header-row");
                
                // go to the next sibing
                while(element = element.nextSibling)
                {
                    if(element.tagName === "TR")
                    {
                        // remove the selected class
                        element.classList.remove("selected");
                    }
                }
                this.parentElement.parentElement.classList.toggle("selected");
            };
        }
    }
    selectRow();
</script>

</body>
<footer> <img align="left" class="mouselogo" src="img/mouse-1.png"
	height="117" width="87">

	<form>
		<fieldset>

			<div class="div-footer">

				<table class="tb-footer">
					<tr class="tr-footer">
						<td class="td-footer"><button class="update" type="submit"
								name="updateEntry">Update Selected</button></td>
						<td class="td-footer"><button class="update" type="submit"
								name="addPup">Add Pups</button></td>
						<td class="td-footer"><button class="update" type="submit"
								name="addBreeder">Add Breeder Pair</button></td>
						<td class="td-footer"><button class="update" type="submit"
								name="addBreeder">Add Litter</button></td>
						<td id="this is an empty cell for spacing">&emsp;&emsp;&emsp;</td>
						<td>Display Report:</td>
						<td><select>
								<option value="survival" selected>- select -</option>
								<option value="survival">Pup Survivability</option>
						</select></td>
						<td><button class="action" type="submit" name="goReport">Go</button></td>

					</tr>
				</table>

			</div>
		</fieldset>

	</form></footer>
<br>&emsp; © 2019, CMSC495 Team #4</br>


</html>
