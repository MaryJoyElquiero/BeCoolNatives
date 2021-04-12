<?php 
if (isset($_POST['signupbtn'])) {
	include_once "conn.php";	
	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);
	$confirmpass=htmlentities($_POST['confirmpass']);

	if ($password===$confirmpass) {
		$sql = "INSERT INTO accounts (email, password)
			VALUES ( '${email}', '${password}');";
			
			if (mysqli_query($conn, $sql)) {
				session_start();
				$_SESSION['password']= $password;
				$_SESSION['email']= $email;
				header("Location:../index.php");
				exit();
			} 
			else {
				header("Location:../signup.php?error=1");
				exit();
			}		
	}
	else{
		header("Location:../signup.php?error=2");
		exit();
	}

			
}

?>