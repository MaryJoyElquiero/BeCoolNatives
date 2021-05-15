<?php 
if (isset($_POST['save'])) {

	include_once "conn.php";

	$cat_id=htmlentities($_POST['cat_id']);
	$cat_desc=htmlentities($_POST['cat_desc']);
	$cat_status=htmlentities($_POST['cat_status']);


	$sql="UPDATE category
		SET cat_desc= '$cat_desc',
		cat_status='$cat_status'
		WHERE cat_id = '$cat_id';";

	if (mysqli_query($conn,$sql)) {
		
		header("Location:../categories.php?error=5");
		exit();
	}
	else{
		header("Location:../categories?error=6");
		exit();
	}
}

 ?>