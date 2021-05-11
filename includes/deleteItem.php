<?php 


if (isset($_POST['delete1'])) {

include_once "conn.php";

	$item_id=htmlentities($_POST['item_id']);

	$sql = "DELETE FROM items WHERE item_id ='$item_id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../shopindex.php?error=3");
						exit();
					} 
					else {
						header("Location:../shopindex.php?error=2");
						exit();
					}		




}

if (isset($_POST['delete2'])) {

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

if (isset($_POST['delete3'])) {

include_once "conn.php";

	$item_id=htmlentities($_POST['item_id']);

	$sql = "DELETE FROM items WHERE item_id ='$item_id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../admin_products.php?error=6");
						exit();
					} 
					else {
						header("Location:../admin_products.php?error=5");
						exit();
					}		




}


 ?>
