<html>
<head>

	<title>RITA - Add Litter</title>
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
<div class="main-body">


		<div class="logo">
			<img align="left" class="ritalogo" src="img/ritalogo-1.png"
				height="97" width="360"></br><br style = "line-height:90px;"></br>
			<h3 class="maintitle">Rodentia Inventory Tracking Application</h3>
		</div>
		<img align="left" class="mouselogo" src="img/mouse-1.png"
				height="117" width="87"> </br>
			</br>
			</br>	<center>
			
  <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
		<fieldset>
			<legend>Add Litter Form</legend>
			<table>
        		<tr>
           			<td>
				<div>
           			<input type="checkbox" name="newLitter" value="newLitter">New Litter
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
			<div class="newLitter" style="display:none">
         		 <tr>
				<td>Pair:</td>
  			<td><select name="pairID">
            	  		<?php getDropDown("pairID", "breeding_pairs", $breedingPair); ?>
							</select></td>
             		</tr>
			</div>
             		<tr>
               			<td>Date of Birth:</td>
     				<td><input type="date" name="birth_date"></td>
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
			</tr>
			<?php
 				if (isset($_POST["add"])) { //if add button is clicked
 				//If newLitter check box is checked call newLitterIncrement from functions.php to create newLitterID
 					if (isset($_POST["newLitter"])) {
 						$litterID = newLitterIncrement();
 					}else {
						$litterID = $_POST['litterID'];			
 					}
					addPups($litterID);
 				}
			?>	
</fieldset>			
	
      </body>
	  
	  
</html>
