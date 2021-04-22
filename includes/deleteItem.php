<?php 


if (isset($_POST['delete'])) {

include_once "conn.php";

	$item_id=htmlentities($_POST['item_id']);

	$sql = "DELETE FROM items WHERE item_id ='$item_id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../products.php?error=6");
						exit();
					} 
					else {
						header("Location:../products.php?error=5");
						exit();
					}		




}


 ?>
