<?php 


if (isset($_POST['save'])) {
	include_once "conn.php";


	$cat_desc=htmlentities($_POST['cat_desc']);
	$cat_status=htmlentities($_POST['cat_status']);


	$sql_check="SELECT cat_id FROM category
									WHERE cat_desc =? or cat_status=?;";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../categories.php?error=1");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "ss", $cat_desc, $cat_status);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (!empty($arr)) {
	 	header("Location:../categories.php?error=2");
	 	exit();
	 }

	 else{

	 	$sql1 = "INSERT INTO category (cat_desc, cat_status)
								VALUES ('$cat_desc','$cat_status');";

								if (mysqli_query($conn, $sql1)) {

									header("Location:../categories.php?error=3");
									exit();
								 }
								 else{
								 	header("Location:../categories.php?error=4");
									exit();
								 }

}

}

 ?>