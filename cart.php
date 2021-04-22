<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>CART</title>
</head>
<body>

<?php 

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}

 ?>


<?php include "custnav.php" ?>
<div class="container">
<div class="cart">
		<div class="title" >
			
			<div class="row">
				<div class="col-7" align="left">
						<p class="fs-3">Shopping Cart</p>
				</div>
				<div class="col-md-5 col-12" align="right">
					<form action="cart.php" method="GET">
					<div class="my-md-2">
						<div class="input-group">
							<input class="searchkey" type="text" name="searchkey" placeholder="Search Cart">
							<button class="searchbtn" name="search"><i class="bi bi-search"></i></button>
						</div>
					</div>
				</form>
				</div>	
			
			
			</div>

		</div>
	
		<div class="cart-head">
			<div class="row">
				<div class="col-3"> <p class="fs-6">Products</p></div>
				<div class="col-2"> <p class="fs-6">Price</p></div>
				<div class="col-2"> <p class="fs-6">Quantity</p></div>
				<div class="col-2"> <p class="fs-6">Total</p></div>
				<div class="col-3"> <p class="fs-6">Actions</p></div>	
			</div>
		</div>


		<?php 

			if (isset($_GET['error'])) {
		switch ($_GET['error']) {
			case 1:
				echo "<p class='text-danger'>Connection Failed</p>";
				break;
			case 2:
				echo "<p class='text-success'>Item Deleted to Cart</p>";
				break;
			case 3:
				echo "<p class='text-success'>Saved</p>";
				break;
			case 4:
				echo "<p class='text-danger'>Not Saved</p>";
				break;
			default:
				echo "";
				break;
		}
	}
?>
			<?php 
				include "includes/conn.php";

				if (isset($_GET['search'])) {
					$searchkey= htmlentities($_GET['searchkey']);

					$sql= "SELECT sh.shop_name
					 	FROM shop sh
					 	JOIN items i
					 	on i.shop_id= sh.shop_id
					 	JOIN cart c
					 	on c.item_id= i.item_id
					 	JOIN accounts ac
					 	ON c.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
						AND i.item_name='$searchkey'
					 	GROUP BY sh.shop_name;";

				}
				else{

					$sql= "SELECT sh.shop_name
					 	FROM shop sh
					 	JOIN items i
					 	on i.shop_id= sh.shop_id
					 	JOIN cart c
					 	on c.item_id= i.item_id
					 	JOIN accounts ac
					 	ON c.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
					 	GROUP BY sh.shop_name;";
					 }

					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location: cart.php?error= Connection Failed");
					exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					if (empty($arr)) {
						echo "<div class='empty'>";
						echo "<p> <i class='bi bi-bag-x'></i>  It's Empty Here </p>";
						echo "</div>";
					}
					foreach ($arr as $key => $val) {
						$shop = $val['shop_name'];

						
				echo "<div class='items'>";
							
							echo "<div class='shopname'> <i class='bi bi-shop'></i>  ". $shop ."</div>";
							echo "<hr>";

						if (isset($_GET['search'])) {
						$searchkey= htmlentities($_GET['searchkey']);

						$sql= "SELECT c.cart_id, ac.acc_id, c.item_id, i.item_img, i.item_name, p.price_amt,c.price_id, SUM(c.item_qty) as total_qty, SUM(c.total_amt) as total_amt2
								FROM cart c
								 JOIN items i
							 	 ON c.item_id= i.item_id
							 	 JOIN price p
							 	 ON i.item_id=p.item_id
							  	JOIN shop sh
								  ON i.shop_id= sh.shop_id
								JOIN accounts ac
								  ON ac.acc_id=c.acc_id
							 	 WHERE sh.shop_name = '$shop'
							 	 AND i.item_name='$searchkey'
							 	 AND ac.email='{$_SESSION['email']}'
							 	 AND ac.password='{$_SESSION['password']}'
							 	 GROUP BY i.item_name;";
							 	}
							 	else{

							$sql= "SELECT c.cart_id, ac.acc_id, c.item_id, i.item_img, i.item_name, p.price_amt, c.price_id,SUM(c.item_qty) as total_qty, SUM(c.total_amt) as total_amt2
								FROM cart c
								 JOIN items i
							 	 ON c.item_id= i.item_id
							 	 JOIN price p
							 	 ON i.item_id=p.item_id
							  	JOIN shop sh
								  ON i.shop_id= sh.shop_id
								JOIN accounts ac
								  ON ac.acc_id=c.acc_id
							 	 WHERE sh.shop_name = '$shop'
							 	 AND ac.email='{$_SESSION['email']}'
							 	 AND ac.password='{$_SESSION['password']}'
							 	 GROUP BY i.item_name;";
							 	}

							  	$stmt= mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: cart.php?error= Connection Failed");
								exit();

								}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					if (empty($arr)) {
						echo "<div class='empty'>";
						echo "<p> <i class='bi bi-bag-x'></i>  It's Empty Here </p>";
						echo "</div>";
					}
					foreach ($arr as $key => $value) {
					echo "<form action='includes/cartaction.php' method='POST'>";

									echo "<input type='hidden' name='item_id' value='". $value['item_id']. "'>";
									echo "<input type='hidden' name='item_img' value='". $value['item_img']. "'>";
									echo "<input type='hidden' name='item_name' value='". $value['item_name']. "'>";
									echo "<input type='hidden' name='item_price' value='". $value['price_amt']. "'>";
									echo "<input type='hidden' name='order_total' value='". $value['total_amt2']. "'>";
									echo "<input type='hidden' name='acc_id' value='". $value['acc_id']. "'>";
									echo "<input type='hidden' name='price_id' value='". $value['price_id']. "'>";



						echo "<div class='row cartitems'>";
							echo "<div class='col-3 pr'>";
								echo "<div class='img-box'>";
									echo "<img src='items/".$value['item_img']."'>";
								echo "</div>";
									echo "<p>".$value['item_name']."</p>";
							echo "</div>";
							echo "<div class='col-2'><p>Php ".number_format($value['price_amt'],2)."</p></div>";
							echo "<div class='col-2 qty'>
								<input type='number' name='order_qty' value='". $value['total_qty']."'>
								<button class='btn btn-outline-success' type='submit' name='confirm'><i class='bi bi-check'></i></button>
								</div>";			
							echo "<div class='col-2'><p>Php".number_format($value['total_amt2'],2)."</p></div>";	
							echo "<div class='col-3 actions'>";	
								echo "<button class='btn btn-outline-success' name='buy'>Buy Now</button>";
								echo "<button class='btn btn-outline-danger' name='delete'><i class='bi bi-trash'></i></button>";
							echo "</div>";			
						echo "</div>";
						echo "<hr>";
					echo "</form>";	

					}

				echo "</div>";
							
						}
			?>
		
</div>
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>





