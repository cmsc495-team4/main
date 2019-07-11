<?php 
	session_start();
	//Check if user has an existing session, else send to login page.
	if (!isset($_SESSION['user_name'])) {
    		header('Location: login.php');
    		exit();
	}
?>

<html>
<head>

	<title>RITA - Add Litter</title>
	<link rel="stylesheet" type="text/css" href="css/mainPageStyle.css">
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
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
	
		<div class="logo">
			<img class="ritalogo" src="img/ritalogo-1.png" height="97"
				width="360">
			<h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
		</div>

</header>

<body>
<?php addUserButton() ?>

<style>
.fixed-bottom-wrapper {
	position: fixed;
	bottom: 0;
	width: 100%;
	z-index: -1;
	padding-bottom: 8px;
}

.fixed-bottom-wrapper img {
	display: table;
	opacity: 0.33;
	position: relative;
	margin: auto;
	width: 315px;
	height: 216px;
	z-index: -1;
}
</style>

<div class="main-body">


			
  <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
		<fieldset style="margin-top: 16px" >
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
         		 <tr>
				 <td><div class="newLitter" style="display:none">Breeding Pair:</div></td>
  			<td><div class="newLitter" style="display:none">
				<select name="pairID">
            	  		<?php getDropDown("pairID", "breeding_pairs", $breedingPair); ?>
				</select></div></td>
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
			</table>
</fieldset>		
</form>
				<div class="fixed-bottom-wrapper">
		<img align="center" class="rodents" src="img/rodentsv3.png"> </br>
		<center> <br>
		&emsp; © 2019, CMSC495 Team #4</br></center>

	</div>
	</div>
	</br>&nbsp;
	</br>

      </body>
	



	  
</html>
