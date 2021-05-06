<?php 

include "conn.php";

if (isset($_POST['packed'])) {
	$order_id= htmlentities($_POST['order_id']);

	$sql="UPDATE orders SET order_status='To Ship' WHERE order_id='$order_id';";

		if (mysqli_query($conn,$sql)) {
					
					header("Location:../seller_toship.php");
					exit();
				}
				else{
					header("Location:../seller_topack.php?error");
					exit();
				}
}


if (isset($_POST['shipped'])) {
	$order_id= htmlentities($_POST['order_id']);

	$sql="UPDATE orders SET order_status='To Recieve' WHERE order_id='$order_id';";

		if (mysqli_query($conn,$sql)) {
					
					header("Location:../seller_shipped.php");
					exit();
				}
				else{
					header("Location:../seller_toship.php?error");
					exit();
				}
}

if (isset($_POST['recieved'])) {
	$order_id= htmlentities($_POST['order_id']);

	$sql="UPDATE orders SET order_status='Completed' WHERE order_id='$order_id';";

		if (mysqli_query($conn,$sql)) {
					
					header("Location:../completed.php");
					exit();
				}
				else{
					header("Location:../torecieve.php?error");
					exit();
				}
}

if (isset($_POST['cancel'])) {
	$order_id= htmlentities($_POST['order_id']);

	$sql="UPDATE orders SET order_status='Cancelled' WHERE order_id='$order_id';";

		if (mysqli_query($conn,$sql)) {
					
					header("Location:../cancelled.php");
					exit();
				}
				else{
					header("Location:../topay.php?error");
					exit();
				}
}


 ?>