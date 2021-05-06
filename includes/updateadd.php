<?php 
include_once "conn.php";

if(isset($_POST['save'])){

	$province=htmlentities($_POST['province']);
	$city=htmlentities($_POST['city']);
	$brgy=htmlentities($_POST['brgy']);
	$add_details=htmlentities($_POST['add_details']);
	$acc_id=htmlentities($_POST['acc_id']);
	$item_id=htmlentities($_POST['item_id']);	
	

	$sql="UPDATE accinfo 
		SET
		province='$province',
		city='$city',
		brgy='$brgy',
		add_details='$add_details'
		WHERE acc_id ='$acc_id';";

	if (mysqli_query($conn,$sql)){
		if (!isset($_POST['item_id'])) {
			header("Location:../account.php?Saved");
			exit();
		}
		else{
			header("Location:../orderform.php?id=$item_id");
			exit();
		}
	}
	else{
		header("Location:../updateaddress.php?error=notsaved");
		exit();
	}
}




 ?>