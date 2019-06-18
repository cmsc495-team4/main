<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
</head>
<header>



  <div>
  <img align="left" src="img/mouse-1.png" height="117" width="87">
    <form>
    <fieldset>
    <legend>Filter Results</legend>
      <table>
        <tr>
          <td>PI:</td>
          <td>
            <select>
        		<?php getInvestigators(); ?>
            </select>
          </td>
          <td>Species:</td>
          <td>
            <select>
              <?php getDropDown("species_name", "species") ?>
            </select>
          </td>
          <td>Strain:</td>
          <td>
            <select>
              <?php getDropDown("strain_name", "strains") ?>
            </select>
          </td>
          <td>
            <input type="checkbox" name="breeders" value="breeders" checked>Breeders
          </td>
          <td>
            <input type="checkbox" name="weanlings" value="weanlings" checked>Weanlings
          </td>
                    <td>
            <input type="checkbox" name="pups" value="pups" checked>Pups/Unclassified
          </td>

          
        </tr>
        <tr>
          <td>Pair:</td>
          <td>
          	<select>
          	  <?php getDropDown("pairID", "breeding_pairs") ?>
			</select>
          </td>
          <td>Tag#:</td>
          <td>
          	<select>
          	  <?php getDropDown("tagNumber", "animals") ?>
			</select>
          </td>
          <td>Litter ID::</td>
          <td>
          	<select>
          	  <?php getDropDown("litterID", "litters") ?>
			</select>
          </td>

          <td>Date of Birth:</td>
          <td>
            <input type="date" name="dob" placeholder="mm/dd/yyyy">
          </td>
          <td><button type="submit" name="filter">Apply Filter</button></td>
        </tr>
      </table>
      </fieldset>
    </form>
  </div>
</header>

<body>
<?php displayAnimalTable() ?>


      <script>
            
            function selectRow(){
        
                var radios = document.getElementsByName("rowselect");
                for( var i = 0; i < radios.length; i++ )
                {
                    radios[i].onclick = function()
                    {
                        // remove class from the other rows
                        
                        var el = document.getElementById("header-row");
                        
                        // go to the nex sibing
                        while(el = el.nextSibling)
                        {
                            if(el.tagName === "TR")
                            {
                                // remove the selected class
                                el.classList.remove("selected");

                            }
                        }
                        
                     // radio  -      td      -          tr 
                        this.parentElement.parentElement.classList.toggle("selected");
                    };
                }
        
            }
            selectRow();
        </script>    
        
</body>
<footer>
<form>
<fieldset>

<div>

  <table>
    <tr>
      <td><button class="update" type="submit" name="updateEntry">Update Selected</button></td>
      <td><button class="update" type="submit" name="addPup">Add Pups</button></td>
      <td><button class="update" type="submit" name="addBreeder">Add Breeder Pair</button></td>
      <td><button class="update" type="submit" name="addBreeder">Add Litter</button></td>

      <td>Display Report:</td>
      <td>
        <select>
          <option value="1">1</option>
        </select>
      </td>
      <td><button type="submit" name="goReport">Go</button></td>

    </tr>
  </table>

</div>
  </fieldset>

</form>
</footer>



</html>