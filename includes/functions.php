<?php  

function createUser($conn, $acc_id, $email, $password){
	$err;
	$sql="INSERT INTO accounts(acc_id,email,password) VALUES (?,?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../login.php?error=connectionfailed");
				exit();
			}

			mysqli_stmt_bind_param($stmt,"sss", $acc_id, $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

}

function uidExists($conn, $email, $password){
		$sql="SELECT * FROM accounts WHERE email=? AND password=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../login.php?error=3");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);


			if ($row=mysqli_fetch_assoc($result)) {
				return $row;

			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}



?>