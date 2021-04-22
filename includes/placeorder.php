<?php 

if (isset($_POST['placeorder'])) {
	include_once "conn.php";
		$acc_id=htmlentities($_POST['acc_id']);
		$item_id=htmlentities($_POST['item_id']);
		$item_price=htmlentities($_POST['item_price']);
		$order_qty=htmlentities($_POST['order_qty']);
		$order_total=htmlentities($_POST['order_total']);
		$billing_info=htmlentities($_POST['billing_info']);
		$order_date=date("Y-m-d");
		$order_status="To Pay";

	$buy="INSERT INTO orders(acc_id, item_id, item_price, order_qty, order_total, order_date, order_status, billing_info) VALUES ('$acc_id','$item_id','$item_price', '$order_qty','$order_total','$order_date','$order_status', '$billing_info')";

		if (mysqli_query($conn, $buy)) {

					$delete="DELETE FROM cart WHERE item_id= '$item_id' AND acc_id ='$acc_id';";

					if (mysqli_query($conn, $delete)) {	
					header("Location:../topay.php");
						exit();
					} 
					else {
						header("Location:../cart.php?error=1");
						exit();
					}	
			} 
		else {
			header("Location:../cart.php?error=1");
			exit();
					}		

}

if (isset($_POST['cancel'])) {
		header("Location:../cart.php");
		exit();
}



 ?>
