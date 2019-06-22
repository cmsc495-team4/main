<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";

$message = '';

//if logged in as Admin
if(empty($_SESSION['user_name']) || $_SESSION['role'] != "Admin"){
	header('Location: login.php');
}else{
	
//if login form submitted
if(isset($_POST['register'])){

	//check both fields filled out 
	if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['fname']) || empty($_POST['lname'])){
		$message = '<label>All fields are required</label>';
	}
	else{
		//check if username exists
			require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";
			
		try{
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$query = $pdo->prepare("SELECT COUNT(username) AS num FROM user WHERE username = ?");
			$query->execute([$_POST['username']]);
			//Fetch row.
			$user = $query->fetch(PDO::FETCH_ASSOC);
    
			//If num > 0, user already exists
			if($user['num'] > 0){
				$message = '<label>Username already exists. Please choose another.</label>';
			}else{
				//Username available. Insert new record

//Temporary password hash
		//$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 12));
		//var_dump($passwordHash);
			
				$date = date('Y-m-d H:i:s'); //for create_time
				$query = $pdo->prepare("INSERT INTO `user` (`username`,`email`,`password`,`create_time`,`last_name`,`first_name`,`user_role`) 
				  VALUES (:username,:email,:password,:createTime,:lname,:fname,:role)");
				$success = $query->execute([':username' => $_POST['username'],
								':email' => $_POST['email'],
								':password' => $passwordHash,
								':createTime' => $date,
								':lname' => $_POST['lname'],
								':fname' => $_POST['fname'],
								':role' => $_POST['role']
								]);
				if($success){
					$message = '<label>New user successfully added</label>';
				}else{
					$message = '<label>Registration failed. Please contact your system administrator.</label>';
				}
			}
	} catch (PDOException $e) {
            $message='<label>Error accessing database</label>';
        }
		//var_dump($_POST);
		
	}
}
}
?>
<html>
<body><center>
<div class="logo">
  <img align="center" class="ritalogo" src="img/ritalogo-1.png" height="97" width="360">
  <h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
</div>

<div class="container">
	<h2>Register New User</h2>
	<?php if(isset($message)){
		echo '<label class="text-danger" style="color:red">'.$message.'</label>';
	} ?>
	<form method="POST">
	<div>
		<label for="username">Username : </label>
		<input type="text" name="username" required>
		<label for="password">Password : </label>
		<input type="password" name="password" required>
	</div></br>
	<div>
		<label for="fname">First Name : </label>
		<input type="text" name="fname" required>
		<label for="lname">Last Name : </label>
		<input type="text" name="lname" required>
	</div></br>
	<div>
		<label for="email">Email : </label>
		<input type="text" name="email" required>
		<label for="role">Role : </label>
		<select name="role">
			<option value="Breeder_Tech">Breeder Tech</option>
			<option value="Investigator">Investigator</option>
			<option value="Geneticist">Geneticist</option>
			<option value="Admin">Administrator</option>
		</select>
	</div></br>
		
		<button type="submit" name="register"> Register User </button>
	</form>
</div>
<div class="container">
	<span class="return"><a href="mainpage.php">Return to Mainpage</a></span>
	<span class="logout"><a href="logout.php">Logout</a></span>
</div>
</html>
</body>
