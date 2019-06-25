<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/addBrPairStyle.css">
</head>

<header>
	<h1>Add Breeder Pair Form</h1>
	<?php
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";
	?>
</header>

<body>
	<div>
		<table class="table1">
			<tr>
				<td>PI:</td>
				<td>
					<select>
						<option value="1">1</option>
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
			</tr>
			<tr>
				<td>Pair #:</td>
				<td>
					<input type="text" name="pairNum" placeholder="Pair #">
				</td>
				<td>Setup Date:</td>
				<td>
					<input type="text" name="setupDate" placeholder="mm/dd/yyyy">
				</td>
				<td>Generation:</td>
				<td>
					<input type="text" name="generation" placeholder="Generation">
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table class="table2">
			<tr>
				<td>Male Tag #:</td>
				<td>
					<input type="text" name="maleTag" placeholder="Male Tag #">
				</td>
				<td>Female Tag #:</td>
				<td>
					<input type="text" name="femaleTag" placeholder="Female Tag #">
				</td>
			</tr>
			<tr>
				<td>Male Strain:</td>
				<td>
					<input type="text" name="maleStrain" placeholder="Male Strain">
				</td>
				<td>Female Strain:</td>
				<td>
					<input type="text" name="femaleStrain" placeholder="Female Strain">
				</td>
			</tr>
			<tr>
				<td>Male DOB:</td>
				<td>
					<input type="text" name="maleDOB" placeholder="mm/dd/yyyy">
				</td>
				<td>Female DOB:</td>
				<td>
					<input type="text" name="femaleDOB" placeholder="mm/dd/yyyy">
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table class="table3">
			<tr>
				<td>Comments:</td>
				<td>
					<textarea id="commentBox" name="commentBox" rows="5" cols="33"></textarea>
				</td>
		</table>
	</div>
	<div class="buttonDiv">
		<button class="button" type="submit" name="add">Add</button>
	</div>
</body>
</html>