<?php

session_start();

unset($_SESSION['user_name']);
unset($_SESSION['role']);
unset($_SESSION['logged_in']);
$_SESSION = array();

session_destroy();

header('Location: login.php');
exit();
