<?php 


if (isset($_POST['delete'])) {
	include_once "conn.php";

$item_id=htmlentities($_POST['item_id']);
$acc_id=htmlentities($_POST['acc_id']);

	$delete="DELETE FROM cart WHERE item_id = '$item_id' AND acc_id ='$acc_id';";

		if (mysqli_query($conn, $delete)) {	
					header("Location:../cart.php?error=2");
						exit();
					} 
					else {
						header("Location:../cart.php?error=1");
						exit();
					}		

}



if (isset($_POST['confirm'])) {
	include_once "conn.php";
	$item_id=htmlentities($_POST['item_id']);
	$item_qty=htmlentities($_POST['order_qty']);
	$acc_id=htmlentities($_POST['acc_id']);
	$price_id=htmlentities($_POST['price_id']);
	$price_amt=htmlentities($_POST['item_price']);
	$total_amt= $item_qty * $price_amt;

	$delete="DELETE FROM cart WHERE item_id = '$item_id' AND acc_id ='$acc_id';";

	if (mysqli_query($conn, $delete)) {	
			$sql="INSERT INTO cart(item_id, acc_id, price_id, item_qty, total_amt)
			VALUES ('$item_id', '$acc_id', '$price_id', '$item_qty', '$total_amt');";
				if (mysqli_query($conn, $sql)) {
					 header("Location:../cart.php?error=3");
					 exit();
				} else {
					header("Location:../cart.php?error=4");
					exit();
				}
	} 
	else {
	header("Location:../cart.php?error=4");
	exit();
	}		


}


if (isset($_POST['buy'])) {
	 $item_id=htmlentities($_POST['item_id']);
	header("Location:../orderform.php?id=$item_id");
	exit();
}

else{
	header("Location:../cart.php");
	exit();
}


 ?>