<?php 
if(isset($_POST['submit'])){
	include_once "conn.php";
	include_once "functions.php";


	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);


	if (uidExists($conn, $email, $password)!==false) {
		session_start();
		$_SESSION['password']= $password;
		$_SESSION['email']= $email;

		header("Location:../index.php?error=4");
		exit();
	
	}
	else{
		header("Location:../login.php?error=2");
		exit();
	}


}
if (isset($_POST['adminlgn'])) {
		include_once "conn.php";
		include_once "functions.php";

		
	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);


	if (adminlogin($conn, $email, $password)!==false) {
		session_start();
		$_SESSION['admin_pass']= $password;
		$_SESSION['admin_email']= $email;

		header("Location:../admin_dashboard.php");
		exit();
	
	}
	else{
		header("Location:../admin_login.php?error=2");
		exit();
	}


	}

 ?>
