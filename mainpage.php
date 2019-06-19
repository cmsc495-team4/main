<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.css"/>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.js"></script>
</head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
?>
<header>
<div class="logo">
  <img class="ritalogo" src="img/ritalogo-1.png" height="97" width="360">
  <h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
</div>
  <div>
    <form>
    <fieldset>
    <legend>Filter Results</legend>
      <table>
        <tr>
          <td>PI:</td>
          <td>
            <select name="pi_name">
        		<?php getInvestigators(); ?>
            </select>
          </td>
          <td>Species:</td>
          <td>
            <select name="species_name">
              <?php getDropDown("species_name", "species") ?>
            </select>
          </td>
          <td>Strain:</td>
          <td>
            <select name="strain_name">
              <?php getDropDown("strain_name", "strains") ?>
            </select>
          </td>
          <td>
          <input type="hidden" name="breeders" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" checked>Breeders

           <!-- <input type="checkbox" name="breeders" value="breeders" checked>Breeders -->
          </td>
          <td>
          <input type="hidden" name="weanlings" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" checked>Weanlings
          </td>
                    <td>
          <input type="hidden" name="pups" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" checked >Pups/Unclassified
          </td>

        </tr>
        <tr>
          <td>Pair:</td>
          <td>
          	<select name="breederPair">
          	  <?php getDropDown("pairID", "breeding_pairs") ?>
			</select>
          </td>
          <td>Tag#:</td>
          <td>
          	<select name="tagNumber"> 
          	  <?php getDropDown("tagNumber", "animals") ?>
			</select>
          </td>
          <td>Litter ID::</td>
          <td>
          	<select name="litterID">
          	  <?php getDropDown("litterID", "litters") ?>
			</select>
          </td>

          <td>Date of Birth:</td>
          <td>
            <input type="date" name="birth_date" placeholder="mm/dd/yyyy">
          </td>
          <td class="filter-button"><button class="action" type="submit" name="filter">Apply Filter</button></td>
        </tr>
      </table>
      </fieldset>
    </form>
  </div>
</header>

<body>
<script>
$(document).ready( function () {
    $('#maintable').DataTable(
        buttons: [
        'copy', 'excel', 'pdf'
    ]);
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
<footer>
  <img align="left" class="mouselogo" src="img/mouse-1.png" height="117" width="87">

<form>
<fieldset>

<div class="div-footer">

  <table class="tb-footer">
    <tr class="tr-footer">
      <td class="td-footer"><button class="update" type="submit" name="updateEntry">Update Selected</button></td>
      <td class="td-footer"><button class="update" type="submit" name="addPup">Add Pups</button></td>
      <td class="td-footer"><button class="update" type="submit" name="addBreeder">Add Breeder Pair</button></td>
      <td class="td-footer"><button class="update" type="submit" name="addBreeder">Add Litter</button></td>
      <td id="this is an empty cell for spacing">&emsp;&emsp;&emsp;</td>
      <td>Display Report:</td>
      <td>
        <select>
          <option value="survival" selected>- select -</option>
          <option value="survival">Pup Survivability</option>
        </select>
      </td>
      <td><button class="action" type="submit" name="goReport">Go</button></td>

    </tr>
  </table>

</div>
  </fieldset>

</form>
</footer>
<br>&emsp; © 2019, CMSC495 Team #4</br>


</html>