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
    <form>
    <fieldset>
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
            <input type="checkbox" name="breeders" value="breeders">Breeders
          </td>
          <td>
            <input type="checkbox" name="weanlings" value="weanlings">Weanlings
          </td>
                    <td>
            <input type="checkbox" name="pups" value="pups">Pups/Unclassified
          </td>

          
        </tr>
        <tr>
          <td>Pair:</td>
          <td>
          	<select>
          	  <?php getDropDown("pairID", "breeders") ?>
			</select>
          </td>
          <td>Tag#:</td>
          <td>
          	<select>
          	  <?php getDropDown("tagNumber", "animals") ?>
			</select>
          </td>
          <td>Date of Birth:</td>
          <td>
            <input type="text" name="dob" placeholder="mm/dd/yyyy">
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

</body>
<footer>
<form>
<fieldset>

<div>

  <table>
    <tr>
      <td><button type="submit" name="updateEntry">Update Selected</button></td>
      <td><button type="submit" name="addPup">Add Pups</button></td>
      <td><button type="submit" name="addBreeder">Add Breeder Pair</button></td>
      <td><button type="submit" name="addBreeder">Add Litter</button></td>

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