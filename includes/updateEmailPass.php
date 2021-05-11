<?php 
session_start();
if (isset($_POST['updateEmail'])) {
	include_once "conn.php";

	$email=htmlentities($_POST['email']);
	$acc_id=htmlentities($_POST['acc_id']);

	$sql="UPDATE accounts
			SET email = '$email'	
			 WHERE acc_id = '$acc_id';";

			 if (mysqli_query($conn,$sql)) {
					$_SESSION['email']= $email;
					
					header("Location:../updateEmailPass.php?error=2");

					exit();
				}
				else{
					header("Location:../updateEmailPass.php?error=3");
					exit();
				}
}

if (isset($_POST['updatePass'])) {
	include_once "conn.php";

	$oldpass=htmlentities($_POST['oldpass']);
	$newpass=htmlentities($_POST['newpass']);
	$confirmnewpass=htmlentities($_POST['confirmnewpass']);
	$acc_id=htmlentities($_POST['acc_id']);

	$sql_check="SELECT password FROM accounts WHERE password=? AND acc_id='$acc_id';";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../updateEmailPass.php?error=1");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "s", $oldpass);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (empty($arr)) {

	 	header("Location:../updateEmailPass.php?error=4");
		exit();

	 }



	if ($newpass!==$confirmnewpass) {
		header("Location:../updateEmailPass.php?error=5");
		exit();
	}
			$sql="UPDATE accounts
			SET password = '$newpass'	
			 WHERE acc_id = '$acc_id';";

			 if (mysqli_query($conn,$sql)) {

			 		$_SESSION['password']= $newpass;

					
					header("Location:../updateEmailPass.php?error=6");
					exit();
				}
				else{
					header("Location:../updateEmailPass.php?error=3");
					exit();
				}
}

 ?>