<?php 

if (isset($_POST['placeorder'])) {
	include_once "conn.php";
		$acc_id=htmlentities($_POST['acc_id']);
		$item_id=htmlentities($_POST['item_id']);
		$item_price=htmlentities($_POST['item_price']);
		$order_qty=htmlentities($_POST['order_qty']);
		$order_total=htmlentities($_POST['order_total']);
		$order_date=date("Y-m-d");
		$order_status="To Pay";

	$buy="INSERT INTO orders(acc_id, item_id, item_price, order_qty, order_total, order_date, order_status) VALUES ('$acc_id','$item_id','$item_price', '$order_qty','$order_total','$order_date','$order_status')";

		if (mysqli_query($conn, $buy)) {	
					header("Location:../myorders.php");
					exit();
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