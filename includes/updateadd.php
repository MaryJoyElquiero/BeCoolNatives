<?php 
include_once "conn.php";

if(isset($_POST['save'])){

	$province=htmlentities($_POST['province']);
	$city=htmlentities($_POST['city']);
	$brgy=htmlentities($_POST['brgy']);
	$add_details=htmlentities($_POST['add_details']);
	$acc_id=htmlentities($_POST['acc_id']);
	$item_id=htmlentities($_POST['item_id']);	
	$id=htmlentities($_POST['id']);	
	$item_qty=htmlentities($_POST['item_qty']);	
	$price_amt=htmlentities($_POST['price_amt']);	
	$total_amt=htmlentities($_POST['total_amt']);	
	

	$sql="UPDATE accinfo 
		SET
		province='$province',
		city='$city',
		brgy='$brgy',
		add_details='$add_details'
		WHERE acc_id ='$acc_id';";

	if (mysqli_query($conn,$sql)){
		if (isset($_POST['id'])) {
			header("Location:../orderform.php?id=$id");
			exit();
		}
		elseif(isset($_POST['item_id'])&&isset($_POST['item_qty'])&&isset($_POST['price_amt'])&&isset($_POST['total_amt'])) {
			header("Location:../orderform2.php?item_id=$item_id&&item_qty=$item_qty&&total_amt=$total_amt&&price_amt=$price_amt");
			exit();
		}
		else{
			
			header("Location:../account.php?Saved");
			exit();
		}
	}
	else{
		header("Location:../updateaddress.php?error=notsaved");
		exit();
	}
}




 ?>
