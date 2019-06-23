<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
		}else{
			//User account found. Check password
			
		
			//Password verification
			$validPassword = password_verify($_POST['password'], $user['password']);
        
			if($validPassword){
				$_SESSION['user_name'] = $user['first_name']." ".$user['last_name'];
				$_SESSION['role'] = $user['user_role'];
				$_SESSION['logged_in'] = time();
            
				header('Location: mainpage.php');
				exit;
            }else{
				$message = '<label>Username/Password invalid</label>';
			}
		}
	} catch (PDOException $e) {
            $message='<label>Error accessing database</label>';
        }
		//----Temporary password hash used to enter into database. Remove from final version        
		//$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 12));
		//var_dump($passwordHash);
		//var_dump($_POST);
		
	}
}
?>
<html>

    <style>
    .fixed-bottom-wrapper{
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .fixed-bottom-wrapper img{
        display: table;
        position: relative;
        margin: auto;
        max-width: 66%;
        height: auto;
   }
   </style>


<body><center>
<div class="logo">
  <img align="center" class="ritalogo" src="img/ritalogo-1.png" height="97" width="360">
  <h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
</div>
<div class="login">
	<h2>Login</h2>
<img align="center" class="mouselogo" src="img/mouse-1.png"
	height="117" width="87">
</br></br></br>
<?php
	if(isset($message)){
		echo '<label class="text-danger" style="color:red">'.$message.'</label>';
	}
?>
	<form method="POST">
		<div>
		<label for="username">Username : </label>
		<input type="text" name="username" required>
		</div></br>
		<div>
		<label for="password">Password : </label>
		<input type="password" name="password" required>
		</div></br>
		<button type="submit" name="submit"> Login </button>
	</form>
</div>
<!--
</br></br>

</br></br></br></br></br></br></br></br></br></br></br>
-->
</div>
<div class="fixed-bottom-wrapper">
<img align="center" class="rodents" src="img/rodentsv3.png"
	height="150" width="350">
	</div>
</body></br></br></br></br></br>
<br>&emsp; © 2019, CMSC495 Team #4</br>
</html>
