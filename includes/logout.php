<?php 
session_start();

if (isset($_POST['logout'])) {
	session_unset();
	session_destroy();

	header("Location:../login.php?error=4");
	exit();
}


if (isset($_POST['adminlogout'])) {
	session_unset();
	session_destroy();

	header("Location:../admin_login.php?error=4");
	exit();
}

 ?>