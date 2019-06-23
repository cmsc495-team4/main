<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . "/lib/functions.php";

$message = '';

// if login form submitted
if (isset($_POST['submit'])) {

    // check both fields filled out
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $message = '<label>All fields are required</label>';
    } else {
        // check credentials
        // if(checkLogin($_POST['username'], $_POST['password'])){
        require $_SERVER['DOCUMENT_ROOT'] . "/lib/dbconfig.php";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $query = $pdo->prepare("SELECT * FROM user WHERE username = ?");
            $query->execute([
                $_POST['username']
            ]);
            // Fetch row with username
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // If $row is FALSE = not found
            if ($user === false) {
                // Could not find a user with that username!
                $message = '<label>Username not found</label>';
            } else {
                // User account found. Check password

                // Password verification
                $validPassword = password_verify($_POST['password'], $user['password']);

                if ($validPassword) {
                    $_SESSION['user_name'] = $user['first_name'] . " " . $user['last_name'];
                    $_SESSION['role'] = $user['user_role'];
                    $_SESSION['logged_in'] = time();

                    header('Location: mainpage.php');
                    exit();
                } else {
                    $message = '<label>Username/Password invalid</label>';
                }
            }
        } catch (PDOException $e) {
            $message = '<label>Error accessing database</label>';
        }
        // ----Temporary password hash used to enter into database. Remove from final version
        // $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 12));
        // var_dump($passwordHash);
        // var_dump($_POST);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

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
	position: relative;
	margin: auto;
	width: auto;
	height: auto;
	z-index: -1;
}

body {
	min-height: 600px;
	background: transparent;
	font-style: normal;
	font-family: Verdana, Arial;
	font-size: 12px;
}

h2 {
	text-align: center;
	font-family: "Avant Garde", Verdana;
	font-size: 18px;
	text-shadow: 1px 1px 4px gray;
}

label, input {
    display: inline-block;
    vertical-align: baseline;
    margin-bottom: 6px;
}
	
button{
    margin: auto;
}
	
input {
  display: inline-block;
  float: right;
}

.loginform {
    width: 204px;
    margin: auto;
    display: block;
    padding-bottom: 16px;
}

.login {
    margin: auto;
}

</style>


<body>
	<div class="main-body">
		<center>
		<div class="logo">
			<img align="center" class="ritalogo" src="img/ritalogo-1.png"
				height="97" width="360">
			<h2 class="maintitle">Rodentia Inventory Tracking Application</h2>
		</div>
		<div class="login">
			<h2>Login</h2>
			<img align="center" class="mouselogo" src="img/mouse-1.png"
				height="117" width="87"> </br>
			</br>
			</br>
<?php
if (isset($message)) {
    echo '<label class="text-danger" style="color:red">' . $message . '</label>';
}
?>
	<form method="POST">
				<div class="loginform">
					<label for="username">Username:&nbsp;</label> <input type="text"
						name="username" required>
						</input>
				</div>
				<div class="loginform">
				</br>
					<label for="password">&nbsp;Password:&nbsp;</label> <input type="password"
						name="password" required>
				</br>
				</div>
				</br>
				<div class="loginform">
					<button type="submit" name="submit">Login</button>
				</div>
				
			</form>
		</div>
	
	</div>
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
