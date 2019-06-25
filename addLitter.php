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
          <!-- <input type="hidden" name="newLitter" value="0" > ?php echo $newLitter; ?>-->
           <td>
						 	<div>
           			<input type="checkbox" name="newLitter" value="newLitter">New Litter
           		</div>
					 </td>
        </tr>
          <tr>
            <td>Pair:</td>
  					<td><select name="pairID">
            	  <?php getDropDown("pairID", "breeding_pairs", $breedingPair); ?>
							</select></td>
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
               <!--?php echo $dob; ?>-->
               	<td>Date of Birth:</td>
     						<td><input type="date" name="birth_date"></td>
							</tr>
							<tr>
								<td>Number of pups:</td>
							 	<td><input type="text" name="numPups"></td>
							</tr>
             <tr>
               <td>Comments:</td>
       				<td>
       					<textarea id="commentBox" name="commentBox" rows="5" cols="33"></textarea>
       				</td>
 							</tr>
							<tr>
								<td><button class="button" type="submit" name="add">Add</button></td>
							</tr>

          </form>

      </body>
</html>
