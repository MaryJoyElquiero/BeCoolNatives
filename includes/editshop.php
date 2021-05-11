<?php 

include "conn.php";

if (isset($_POST['saveedit'])) {
	$shop_name=htmlentities($_POST['shop_name']);
	$shop_id=htmlentities($_POST['shop_id']);

	$sql="UPDATE shop  
			SET shop_name = '$shop_name'
			 WHERE shop_id = '$shop_id';";
	

				if (mysqli_query($conn,$sql)) {
					
					header("Location:../shopview.php?saved");
					exit();
				}
				else{
					header("Location:../shopview.php?notsaved");
					exit();
				}
}

 ?>