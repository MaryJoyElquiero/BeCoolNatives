<?php  

function createUser($conn, $email, $password){
	$err;
	$sql="INSERT INTO accounts(email,password) VALUES (?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../login.php?error=connectionfailed");
				$err=false;
				return $err;
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$err= true;
			return $err;

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

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}


function adminlogin($conn, $email, $password){
		$sql="SELECT * FROM admin WHERE admin_email=? AND admin_pass=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_login.php?error=3");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}

function emailExists($conn, $email){
		$sql="SELECT * FROM accounts WHERE email=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../login.php?error=3");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"s", $email);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}

?>
