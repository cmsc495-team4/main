<?php
session_start();
//Check if user has an existing session, else send to login page.

if (!isset($_SESSION['user_name'])) {
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

if (isset($_POST["clear"])) {
    $_POST = array();
    $_REQUEST = array();
    $last_pi_name = "";
    $litterID = "";
    $tagNumber = "";
    $breedingPair = "";
    $species_name = "";
    $genotype = "";
    $breederChecked = "checked";
    $weanlingChecked = "checked";
    $pupChecked = "checked";
    $strain_name = "";
    $dob = " placeholder=\"mm/dd/yyyy\"";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>RITA - Main Page</title>
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
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




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
	
	
<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">


</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
?>
<body style="padding: 4px;">

	<header style="padding: 4px;">
		<div class="logo">
			<img class="ritalogo" src="img/ritalogo-1.png" height="97"
				width="360">
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
		<div style="height: auto; width: auto;">
			<form class="header-form" action="<?php $_SERVER['REQUEST_URI']?>"
				method="POST">
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
          	  <?php getDropDown("genotype", "animals", $genotype); ?>
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
    $('table.display tr.even').hover(function(){
        $(this).css('background-color','#ffa'); 
     });
     $('table.display tr.even').mouseout(function(){
        $(this).css('background-color','#ffffff'); 
     }); 
     $('table.display tr.odd').hover(function(){
         $(this).css('background-color','#ffa'); 
      });
      $('table.display tr.odd').mouseout(function(){
         $(this).css('background-color','#f9f9f9'); 
      }); 

//   //assume newW is a calculated value that I produce with every resize, i.e., the 'available width'
//     $('table.maintable').css('width', new);
//     $('div.dataTables_scroll').css('width', new);
//     $('#maintable_wrapper div.row').css('margin-left', '0px'); //this simply overcomes an enclosing margin of -15 (something from bootstrap)
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

	<footer>
		<img align="left" class="mouselogo" src="img/mouse-1.png" height="117"
			width="87">

		<form>
			<fieldset>

				<div class="div-footer">

					<table class="tb-footer">
						<tr class="tr-footer">
							<td class="td-footer"><button class="update" type="button"
								name="addLitter" onclick="window.location='addLitter.php'">Add Litter</button></td>
              						<td class="td-footer"><button class="update" type="button"
    								name="addAnimal" onclick="window.location='addNewAnimal.php'">Add Animal</button></td>
							<td class="td-footer"><button class="update" type="button"
								name="addBreeder" onclick="window.location='addBreedingPair.php'">Add Breeder Pair</button></td>
              						<td class="td-footer"><button class="update" type="button"
    					    			name="updateEntry" onclick="window.location='updateAnimal.php'">Update Animal</button></td>
              						<td class="td-footer"><button class="update" type="button"
    								name="updateBreederPair" onclick="window.location='updateBrPair.php'">Update Breeder Pair</button></td>
							<td class="td-footer"><button class="button" type="submit"
								name="delete" onclick="deleteConfirm()">Delete entry</button></td>
							<td id="this is an empty cell for spacing">&emsp;&emsp;&emsp;</td>
							<td>Display Report:</td>
							<td><select id="report">
								<option value="" selected>- select -</option>
								<option value="survival">Pup Survivability</option>
								<option value="weaning">Pups to be Weaned</option>
							</select></td>
							<td><button class="action" type="button" id="goReport">Go</button></td>
							<script>
								const map = {survival: 'http://495team4.com/SurvivabilityOfPups.php',weaning: 'http://495team4.com/WeanlingReport.php'}
								document.getElementById('goReport').addEventListener('click', () => location.href = map[document.getElementById('report').value])
							</script>
						</tr>
					</table>

				</div>
			</fieldset>

		</form>
	</footer>
	  <script type="text/javascript">

	    var selectedValue;
	    $(document).ready(function () {
	    $("input[type='radio']").on('change', function () {
	      selectedValue = $("input[name='rowselect']:checked").val();

	      });
	    });

	    function deleteConfirm(){
	      var txt;
	      var r = confirm("Are you sure you want to delete\nPress Ok to delete, cancel to return.");
	      if (r == true) {
		if (selectedValue) {
		  $.ajax({
		    url: "deleteAnimal.php",
		    method: "POST",
		    data: { "selectedValue": selectedValue }
		  })
		  alert("Animal Deleted")
		}else {
		  alert("Select an animal.");
		}
	      }
	    }
  </script>
	<br>&emsp; © 2019, CMSC495 Team #4
	</br>
</body>


</html>
