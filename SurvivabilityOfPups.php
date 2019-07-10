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
		
	<link rel="stylesheet" type="text/css" href="css/SurvivabilityOfPups.css">
	<link rel="stylesheet" type="text/css" href="css/userDropdown.css">
	
</head>

<header>
	<h1>Survivabiliy of Pups</h1>
</header>

<body>
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
	<?php pupSurvivabilityReportTable(); 
	addUserButton();
	?>
</body>
</html>
