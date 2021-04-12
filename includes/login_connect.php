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
		header("Location:../index.php?loginsuccess");
		exit();
	}
	else{
		header("Location:../login.php?error=2");
		exit();
	}
}


 ?>