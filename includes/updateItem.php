<?php 
include_once "conn.php";

if(isset($_POST['save'])){
	$item_img=$_FILES['item_img']['name'];
	$item_name=htmlentities($_POST['item_name']);
	$item_sc=htmlentities($_POST['item_sc']);
	$price_amt=htmlentities($_POST['price_amt']);
	$cat_desc=htmlentities($_POST['cat_desc']);
	$item_id=htmlentities($_POST['item_id']);
	$item_stat=htmlentities($_POST['item_stat']);

	$target = "../items/" .basename($_FILES['item_img']['name']);

	if (empty($item_img)){
		
		if (empty($item_stat)) {
			$sql="UPDATE items i 
			JOIN price p 
			ON p.price_id=i.price_id
			SET i.item_name = '$item_name',
			 i.item_short_code = '$item_sc',
			 i.cat_id = '$cat_desc',
			 p.price_amt = '$price_amt'
			 WHERE i.item_id = '$item_id';";
		}
		else{

			$sql="UPDATE items i 
			JOIN price p 
			ON p.price_id=i.price_id
			SET i.item_name = '$item_name',
			 i.item_short_code = '$item_sc',
			 i.cat_id = '$cat_desc',
			 p.price_amt = '$price_amt',
			 i.item_stat = '$item_stat'
			 WHERE i.item_id = '$item_id';";
	}

		

				if (mysqli_query($conn,$sql)) {
					
					header("Location:../products.php?error=7");
					exit();
				}
				else{
					header("Location:../products.php?error=8");
					exit();
				}
} 


	else{
					
			 	if (move_uploaded_file($_FILES['item_img']['tmp_name'], $target)) {

			 		$sql="UPDATE items i 
					JOIN price p 
					ON p.price_id=i.price_id
					SET i.item_img ='$item_img',
					i.item_name = '$item_name',
					 i.item_short_code = '$item_sc',
					 i.cat_id = '$cat_desc',
					 p.price_amt = '$price_amt',
					 i.item_stat='$item_stat'
					 WHERE i.item_id = '$item_id';";
	
								if (mysqli_query($conn,$sql)) {
									
									header("Location:../products.php?error=7");
									exit();
								}
								else{
									header("Location:../products,php?error=8");
									exit();
								}
				}
				else{
					header("Location:../products.php?error=8");
					exit();
				}
			}
			


}

 ?>
