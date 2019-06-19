<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";

$message = '';

//if login form submitted
if(isset($_POST['submit'])){

	//check both fields filled out 
	if(empty($_POST['username']) || empty($_POST['password'])){
		$message = '<label>All fields are required</label>';
	}
	else{
		//check credentials
		//if(checkLogin($_POST['username'], $_POST['password'])){
			require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
			
		try{
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$query = $pdo->prepare("SELECT * FROM user WHERE username = ?");
		$query->execute([$_POST['username']]);
		//Fetch row with username
		$user = $query->fetch(PDO::FETCH_ASSOC);
    
		//If $row is FALSE = not found
		if($user === false){
			//Could not find a user with that username!
			$message = '<label>Username not found</label>';
		}else if($user['user_role'] != "Admin"){
			$message = '<label>User does not have administrative access</label>';
		}else{
			//User account found. Check password
		
			//Password verification
			$validPassword = password_verify($_POST['password'], $user['password']);
        
			if($validPassword){
				$_SESSION['user_name'] = $user['first_name']." ".$user['last_name'];
				$_SESSION['role'] = $user['user_role'];
				$_SESSION['logged_in'] = time();
            
				header('Location: register.php');
				exit;
            }else{
				$message = '<label>Username/Password invalid</label>';
			}
		}
	} catch (PDOException $e) {
            $message='<label>Error accessing database</label>';
        }
		var_dump($_POST);
		
	}
}
?>
<html>
<body>
<div class="logo">
  <img align="center" class="ritalogo" src="img/ritalogo-1.png" height="97" width="360">
  <h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
</div>
<div class="container">
	<h2>Administrator Login</h2>
	<?php if(isset($message)){
		echo '<label class="text-danger" style="color:red">'.$message.'</label>';
	}?>
	<form method="POST">
		<div>
		<label for="username">Admin Username : </label>
		<input type="text" name="username" required>
		</div>
		<div>
		<label for="password">Admin Password : </label>
		<input type="password" name="password" required>
		</div>
		<button type="submit" name="submit"> Login </button>
	</form>
</div>
<div class="container">
	<span class="user_login"><a href="login.php">Return to User Login</a></span>
</div>
</html>
</body>
