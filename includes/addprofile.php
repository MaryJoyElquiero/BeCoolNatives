<?php 
session_start();
if (isset($_POST['save'])) {
	$fn=htmlentities($_POST['fn']);
	$age=htmlentities($_POST['age']);
	$gender=htmlentities($_POST['gender']);
	$pn=htmlentities($_POST['pn']);
	$province=htmlentities($_POST['province']);
	$city=htmlentities($_POST['city']);
	$brgy=htmlentities($_POST['brgy']);
	$add_details=htmlentities($_POST['add_details']);
	
if (isset($_SESSION['email']) || isset($_SESSION['password'])) {
	include_once "conn.php";
	
	
	if ($age < 13) {
		header("Location:../profile.php?error=4");
		exit();
	}

	$sql= "SELECT id FROM accounts WHERE email='{$_SESSION['email']}' AND password='{$_SESSION['password']}';";
					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location:../profile.php?error=1");
						exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while($row=mysqli_fetch_assoc($result)) {
						array_push($arr, $row);
					}

					foreach ($arr as $key => $val){

						$sql1 = "INSERT INTO accinfo (acc_cn, acc_age, acc_gender, acc_contact, province, city, brgy, add_details, account_id)
								VALUES ('$fn','$age','$gender','$pn','$province', '$city', '$brgy', '$add_details', '{$val['id']}');";

								if (mysqli_query($conn, $sql1)) {

									$sql2="UPDATE accounts a
											JOIN accinfo ai
											ON a.id= ai.account_id
											SET a.acc_id = ai.acc_id
											WHERE email='{$_SESSION['email']}' AND password='{$_SESSION['password']}';";

											if (mysqli_query($conn, $sql2)) {

											header("Location:../index.php?error=3");
											exit();
											} 
											else {
												header("Location:../profile.php?error=2");
												exit();
													}	
								} 
								else {
									header("Location:../profile.php?error=2");
									exit();
								}	
						
}
		
}

else{
	header("Location:../signup.php?error=3");
	exit();
}


}

 ?>
