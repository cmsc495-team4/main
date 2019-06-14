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
              <option value="1">1</option>
            </select>
          </td>
          <td>Strain:</td>
          <td>
            <select>
              <option value="1">1</option>
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
            <input type="text" name="pair" placeholder="Pair">
          </td>
          <td>Tag#:</td>
          <td>
            <input type="text" name="tag" placeholder="Tag#">
          </td>
          <td>Date of Birth:</td>
          <td>
            <input type="text" name="dob" placeholder="mm/dd/yyyy">
          </td>
          <td><button type="submit" name="filter">Filter</button></td>
        </tr>
      </table>
    </form>
  </div>
</header>
<body>

<?php displayAnimalTable() ?>

</body>
<footer>
<form>
<div>
  <table>
    <tr>
      <td><button type="submit" name="addPup">Add pups</button></td>
      <td><button type="submit" name="assBreeder">Add breeder pair</button></td>
      <td><button type="submit" name="updateEntry">Update animal entry</button></td>
      <td>Reports:</td>
      <td>
        <select>
          <option value="1">1</option>
        </select>
      </td>
    </tr>
  </table>
</div>
</form>
</footer>
</html>