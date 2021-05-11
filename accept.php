<?php 

if (isset($_POST['accept'])) {
	include "conn.php";

	$item_id=htmlentities($_POST['item_id']);

	$sql="UPDATE items
			SET item_stat = 'Active'
			 WHERE item_id = '$item_id';";


			 	if (mysqli_query($conn,$sql)) {
					
					header("Location:../admin_requests.php?error=7");
					exit();
				}
				else{
					header("Location:../admin_requests.php?error=8");
					exit();
				}
}
if (isset($_POST['deny'])) {
	include "conn.php";

	$item_id=htmlentities($_POST['item_id']);

	$sql="UPDATE items
			SET item_stat = 'Denied'
			 WHERE item_id = '$item_id';";

			 	if (mysqli_query($conn,$sql)) {
					
					header("Location:../admin_requests.php?error=7");
					exit();
				}
				else{
					header("Location:../admin_requests.php?error=8");
					exit();
				}
}

 ?>