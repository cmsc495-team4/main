<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";

	//Check if user has an existing session, else send to login page.
	if (!isset($_SESSION['user_name'])) {
    		header('Location: login.php');
    		exit();
	}
	
	$message = '';
	$startDOB = " placeholder=\"mm/dd/yyyy\"";
	$endDOB = " placeholder=\"mm/dd/yyyy\"";
	
	if(isset($_POST['search']))
	{
		if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
			$startDOB = " value=" . "\"" . $_POST['startDate'] . "\"";
			$endDOB = " value=" . "\"" . $_POST['endDate'] . "\"";
		} elseif (empty($_POST['startDate']) && empty($_POST['endDate'])){
			$startDOB = " placeholder=\"mm/dd/yyyy\"";
			$endDOB = " placeholder=\"mm/dd/yyyy\"";
		} else {
			$message = '<label>Please fill out both date fields, or leave both blank for all Weanlings.</label>';
			$startDOB = " placeholder=\"mm/dd/yyyy\"";
			$endDOB = " placeholder=\"mm/dd/yyyy\"";
		}
		
	}
	
	if (isset($_POST["clear"])) {
		$_POST = array();
		$_REQUEST = array();
		$startDOB = " placeholder=\"mm/dd/yyyy\"";
		$endDOB = " placeholder=\"mm/dd/yyyy\"";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.css" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.dataTables.css" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.css" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.css" />
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.css" />

	<script type="text/javascript"
		src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<link rel="stylesheet"
		href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




	<script type="text/javascript"
		src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.js"></script>
	<script type="text/javascript"
		src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.js"></script>
		
	<link rel="stylesheet" type="text/css" href="css/WeanlingReport.css">
	
</head>

<header>
	<h1>Pups to be Weaned</h1>
</header>

<body>
	<?php
		if (isset($message)) {
			echo '<label class="text-danger" style="color:red">' . $message . '</label>';
		}
	?>
	<form method="POST">
		<div class="selection">
			<table>
				<tr>
					<td>Between</td>
					<td><input type="date" name="startDate" <?php echo $startDOB?>></td>
					<td>and</td>
					<td><input type="date" name="endDate" <?php echo $endDOB?>></td>
					<td>
						<button type="submit" name="search">Submit</button>
					</td>
					<td>
						<button type="submit" name="clear">Clear</button>
					</td>
				</tr>
			</table>
		</div>
	</form>
	<script>
		$(document).ready( function () {
			$('#maintable').DataTable({
				responsive: true
			});
			$('table.display tr.even').hover(function(){
				$(this).css('background-color','#ffa'); 
			});
			$('table.display tr.even').mouseout(function(){
				$(this).css('background-color','#ffffff'); 
			}); 
			$('table.display tr.odd').hover(function(){
				$(this).css('background-color','#ffa'); 
			});
			$('table.display tr.odd').mouseout(function(){
				$(this).css('background-color','#f9f9f9'); 
			}); 
		} );
	</script>
	<?php displayWeanlingReportTable() ?>
</body>
</html>
