<html>
<head>
	<title>Add Litter</title>
	<link rel="stylesheet" type="text/css" href="css/addPupsStyle.css">
</head>

<header>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
  ?>

	<!--script to toggle add to existing dropdown: will disappear if new litter box is checked-->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			$('input[type="checkbox"]').click(function(){
			var inputValue = $(this).attr("value");
			$("." + inputValue).toggle();
		});
	});</script>

</header>

<body>
  <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
		<fieldset>
			<legend>Add Litter Form</legend>
			<table>
        <tr>
           <td>
						 	<div>
           			<input type="checkbox" name="newLitterID" value="newLitter">New Litter
           		</div>
					 </td>
					 <td>
						 <div class="newLitter">
							 <label for="litterID">Add to existing Litter:</label>
							 <select name="litterID">
								 <?php getDropDown("litterID", "litters", $litterID); ?>
								 </select>
						 </div>
					 </td>
        </tr>
          <tr>
            <td>Pair:</td>
  					<td><select name="pairID" required>
            	  <?php getDropDown("pairID", "breeding_pairs", $breedingPair);
								?>
							</select></td>
             </tr>
             <tr>
               	<td>Date of Birth:</td>
     						<td><input type="date" name="birth_date" required></td>
							</tr>
							<tr>
								<td>Number of pups:</td>
							 	<td><input type="text" name="numPups" required></td>

							</tr>
             <tr>
               <td><label for="commentBox">Comments:</label></td>
       				<td>
       					<textarea id="commentBox" name="commentBox" rows="5" cols="33"></textarea>
       				</td>
 							</tr>
							<tr>
								<td><button class="button" type="submit" name="add">Add</button></td>

								<?php
								if (isset($_POST["add"])) { //if add button is clicked
									//If newLitter check box is checked call newLitterIncrement from functions.php to create newLitterID
									if (isset($_POST["newLitterID"])) {
										$litterID = newLitterIncrement();
									}
										$numPups = $_POST['numPups'];
										$dob = $_POST['birth_date'];
										$comments = $_POST['commentBox'];
										addPups($litterID,$breedingPair, $numPups, $dob,$comments);

								}
								?>
							</tr>

          </form>

      </body>
</html>
