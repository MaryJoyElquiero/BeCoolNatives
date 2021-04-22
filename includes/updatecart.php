<?php 

if (isset($_POST['confirm'])) {
	include_once "conn.php";
	$item_id=htmlentities($_POST['item_id']);
	$item_qty=htmlentities($_POST['order_qty']);
	$acc_id=htmlentities($_POST['acc_id']);

	$sql="UPDATE cart 
		SET item_qty = '$item_qty'
		WHERE item_id='$item_id' AND acc_id='$acc_id';";

		if ($conn->query($sql) === TRUE) {
									  header("Location:../cart.php?error=3");
									  exit();
									} else {
									  header("Location:../cart.php?error=4");
									  exit();
									}

									$conn->close();	

}


 ?>