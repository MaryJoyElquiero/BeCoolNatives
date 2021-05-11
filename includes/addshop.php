<?php 
session_start();
if (isset($_POST['save'])) {
	include_once "conn.php";

	$shop_name=htmlentities($_POST['shop_name']);

	$sql="SELECT acc_id FROM accounts WHERE email='{$_SESSION['email']}' 
	and password='{$_SESSION['password']}';";
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result)) { 
	    while ($row = mysqli_fetch_assoc($result)) { 
	        $acc_id=$row['acc_id'];
	    }

	$sql2="INSERT INTO shop(shop_name, acc_id) VALUES (?,?);";
	$stmt= mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql2)) {
		header("Location:../shopindex.php?error");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $shop_name, $acc_id);
	mysqli_stmt_execute($stmt);

	header("Location:../shopindex.php");
	exit();
}
}
 ?>
