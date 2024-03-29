<?php 
session_start();
if (isset($_POST['save'])) {
	include_once "conn.php";

	$item_img=$_FILES['item_img']['name'];
	
	$item_sc=htmlentities($_POST['item_short_code']);
	$item_price=htmlentities($_POST['item_price']);
	$item_ct=htmlentities($_POST['item_category']);
	$item_stat="Pending";

	$target = "../items/" .basename($_FILES['item_img']['name']);
	$imageFileType = strtolower(pathinfo($target,PATHINFO_EXTENSION));
	$item_name=htmlentities($_POST['item_name']);

	$sql_check="SELECT i.item_id FROM items i
									JOIN shop sh
									ON i.shop_id=sh.shop_id
									JOIN accounts a
									ON a.acc_id=sh.acc_id	
									WHERE item_name =? or item_short_code=?							
									AND a.email='{$_SESSION['email']}'
									AND a.password='{$_SESSION['password']}'";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../products.php?error=1");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "ss", $item_name, $item_sc);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (!empty($arr)) {
	 	header("Location:../products.php?error=2");
	 	exit();
	 }
	 else {



	 	$check = getimagesize($_FILES['item_img']['tmp_name']);
	  if($check == false) {

	  	header("Location: ../products.php?error=9");
		  exit();
	    
	  }


		if($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" ) {
		  header("Location: ../products.php?error=10");
		  exit();

		}

		if ($_FILES['item_img']['size'] > 500000) {
		   header("Location: ../products.php?error=11");
		  exit();

		}

	 		$sql="SELECT sh.shop_id FROM shop sh
	 		JOIN accounts a
	 		ON sh.acc_id=a.acc_id
	 		 WHERE email='{$_SESSION['email']}' 
			and password='{$_SESSION['password']}';";
			$result = mysqli_query($conn, $sql); 
			if (mysqli_num_rows($result)) { 
	 		   while ($row = mysqli_fetch_assoc($result)) { 
	        			$shop_id=$row['shop_id'];
	   			 		}
	 	
					 } 

	 	$stmt = $conn->prepare( "INSERT INTO items(item_img, item_name, item_short_code,cat_id,item_stat,shop_id) 
	 	VALUES (?,?,?,?,?,?);");
			$stmt->bind_param("ssssss" ,$item_img , $item_name, $item_sc,$item_ct, $item_stat,$shop_id);
			$stmt->execute();
			$stmt->close();

			if (move_uploaded_file($_FILES['item_img']['tmp_name'], $target)) {

				$sql2= "SELECT item_id FROM items WHERE item_name='$item_name' and item_short_code='$item_sc';";
					$stmt2= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt2,$sql2)) {
						header("Location:../products.php?error=4");
						exit();

					}
					mysqli_stmt_execute($stmt2);
					$result=mysqli_Stmt_get_result($stmt2);
					$arr2= array();
					while ($row2=mysqli_fetch_assoc($result)) {
						array_push($arr2, $row2);
					}
					foreach ($arr2 as $key => $val) {
					
					$stmt3 = "INSERT INTO price(price_amt, item_id) 
	 				VALUES ('$item_price', '{$val['item_id']}');";
					
					if (mysqli_query($conn, $stmt3)) {
								$sql3= "UPDATE items i 
								JOIN price p 
								ON i.item_id=p.item_id  
								SET i.price_id=p.price_id 
								WHERE i.item_name='$item_name' and i.item_short_code='$item_sc';";

									if ($conn->query($sql3) === TRUE) {
									  header("Location:../products.php?error=3");
									  exit();
									} else {
									  header("Location:../products.php?error=4");
									  exit();
									}

									$conn->close();
						
					} 
					else {
						header("Location:../products.php?error=1");
						exit();
					}		

					}
				
					
				

				}

			else{
				header("Location:../products.php?error=4");
				exit();
				}
				
	 
	 }

}
 ?>
