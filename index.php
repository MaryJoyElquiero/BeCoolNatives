<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>HOME</title>
</head>
<body>

<?php include "custnav.php" ?>


<div class="items">
	

	<div class="categories">
		<form method="POST" action="index.php" class="category">
		<button type="submit" name="categoryAll">All</button>
	</form>
		<?php 
		include "includes/conn.php";

		$sql= "SELECT * FROM category WHERE cat_status ='A';";

		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location: index.php?error=1");
			exit();

		}
		mysqli_stmt_execute($stmt);
		$result=mysqli_Stmt_get_result($stmt);
		$arr= array();
		while ($row=mysqli_fetch_assoc($result)) {
			array_push($arr, $row);
		}
		foreach ($arr as $key => $val) {
			
			echo "<form method='POST' action='index.php' class='category'>";
			echo "<input type='hidden' name='cat_desc' value=".$val['cat_desc'].">";
			echo "<button type='submit' name='category'>".$val['cat_desc']."</button>";
			echo "</form>";
		
	
		}

		 ?>
		
	</div>


	
		<?php 

			if (isset($_GET['error'])) {
		switch ($_GET['error']) {
			case 1:
				echo "<p class='text-danger' align='center'>Connection Failed</p>";
				break;
			case 2:
				echo "<p class='text-success' align='center'>Added to Cart</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}

		include "includes/conn.php";
	
		if (isset($_POST['category'])) {
		$category=$_POST['cat_desc'];
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									WHERE i.item_stat='Active'
									AND ct.cat_desc='$category';";
		}
		elseif(isset($_POST['categoryAll'])) {
			$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									WHERE i.item_stat='Active';";
		}

		else{
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name,p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									WHERE i.item_stat='Active';";
		}
		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location: index.php?error= Connection Failed");
			exit();
		}
		mysqli_stmt_execute($stmt);
		$result=mysqli_Stmt_get_result($stmt);
		$arr= array();
		while ($row=mysqli_fetch_assoc($result)) {
			array_push($arr, $row);
		}
		foreach ($arr as $key => $val) {


	
			echo "<div class='content'>";

			echo "<form action='includes/addtocart.php' method='POST'>";
						echo "<input type='hidden' name='item_id' value='".$val['item_id']."'>";
						echo "<input type='hidden' name='price_id' value='".$val['price_id']."'>";
						echo "<input type='hidden' name='price_amt' value='".$val['price_amt']."'>";
						echo "<div class='img-box'>";
						echo "<img src='items/".$val['item_img']."' >";
						echo "<div class='details'>";
						echo "<p>".$val['item_name']."</p>";
						echo "<div class='price'>P".$val['price_amt']."</div>";
						?>

						<div class="itemqty">
							<input type="text" name="item_qty" placeholder="set quantity" required="">
						</div>
						<div class="actions">
						<button name="addtocartbtn" type="submit">
							<h4><i class="bi bi-cart-plus"></i></h4>
						</button>
						<button name="buynow" type="submit">Buy Now</button>
						</div>
						</form>
						<?php
						echo "</div>";
						echo "</div>";
			echo "</div>";
	
		}

		 ?>
</div>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>



</script>
</body>
</html>


