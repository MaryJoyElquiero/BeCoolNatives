<?php 
include_once "conn.php";

if(isset($_POST['save'])){
	$cn=htmlentities($_POST['cn']);
	$age=htmlentities($_POST['age']);
	$pn=htmlentities($_POST['pn']);
	$province=htmlentities($_POST['province']);
	$city=htmlentities($_POST['city']);
	$brgy=htmlentities($_POST['brgy']);
	$add_details=htmlentities($_POST['add_details']);
	$gender=htmlentities($_POST['gender']);
	$acc_id=htmlentities($_POST['acc_id']);

	$sql="UPDATE accinfo 
		SET acc_cn= '$cn',
		acc_age='$age',
		acc_gender='$gender',
		acc_contact='$pn',
		province='$province',
		city='$city',
		brgy='$brgy',
		add_details='$add_details'
		WHERE acc_id = '$acc_id' ;";

	if (mysqli_query($conn,$sql)) {
		
		header("Location:../editprofile.php?error=2");
		exit();
	}
	else{
		header("Location:../editprofile?error=1");
		exit();
	}
}




 ?>