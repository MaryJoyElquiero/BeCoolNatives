<?php 


include_once "conn.php";

if (isset($_POST['delete'])) {

	$sql = "DELETE FROM items WHERE id ='$id';";


	if ($conn->query($sql) === TRUE) {
		header("Location:../upload.php?error=6");
	}

	else{
		header("Location:../upload.php?error=5");
		
		}
	}






 ?>