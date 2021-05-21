<?php 
if (isset($_POST['signupbtn'])) {
	include_once "conn.php";	
	include_once "functions.php";	

	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);
	$confirmpass=htmlentities($_POST['confirmpass']);

	
		if (emailExists($conn, $email)!==false) {
			header("Location:../signup.php?error=5");
			exit();
		}

		if ($password!==$confirmpass) {
			header("Location:../signup.php?error=2");
			exit();

		}
		if (strlen($password)<6) {
			header("Location:../signup.php?error=6");
			exit();
		}

		if (createUser($conn, $email, $password)!==false) {
			session_start();
			$_SESSION['password']= $password;
			$_SESSION['email']= $email;

			header("Location:../profile.php");
			exit();

		}
		else{
		header("Location:../signup.php?error=4");
		exit();
	}

			
}

?>
