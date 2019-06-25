<html>
<head>
	<title>Add Litter</title>
	<link rel="stylesheet" type="text/css" href="addPupsStyle.css">
</head>

<header>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
  ?>
</header>

<body>
  <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
		<fieldset>
			<legend>Add Litter Form</legend>
			<table>
        <tr>
          <!-- <input type="hidden" name="newLitter" value="0" > ?php echo $newLitter; ?>-->
           <td><input type="checkbox" name="newLitter">New Litter</td>
        </tr>
          <tr>
            <td>Pair:</td>
  					<td><select name="pairID">
            	  <?php getDropDown("pairID", "breeding_pairs", $breedingPair); ?>
  		         </select></td>
               <td>Add to existing Litter:</td>
     					<td><select name="litterID">
               	  <?php getDropDown("litterID", "litters", $litterID); ?>
     			        </select></td>
             </tr>
             <tr>
               <!--?php echo $dob; ?>-->
               <td>Date of Birth:</td>
     					<td><input type="date" name="birth_date"></td>
              <td>Number of pups:</td>
             <td><input type="text" name="numPups"></td>
             </tr>
             <tr>
               <td>Comments:</td>
       				<td>
       					<textarea id="commentBox" name="commentBox" rows="5" cols="33"></textarea>
       				</td>
              <td><button class="button" type="submit" name="add">Add</button></td>

             </tr>

            	</form>

            </body>
</html>
