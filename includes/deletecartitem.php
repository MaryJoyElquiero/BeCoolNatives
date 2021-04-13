<?php
session_start();

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





?>