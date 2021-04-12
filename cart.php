<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="font/font/bootstrap-icons.css">
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
<div class="container-fluid">
<div class="cart">
<div class="title" >
	
	<div class="row">
		<div class="col-7" align="left">
				<p class="fs-3">Shopping Cart</p>
		</div>
		<div class="col-5" align="right">	
				<div class="input-group">
					<input class="form-control" type="text" name="search" placeholder="Search Cart">
					<button class="btn btn-outline-dark"><i class="bi bi-search"></i></button>
				</div>
		
		</div>
	
	
	</div>

</div>
	
		<div class="cart-head">
			<div class="row">
				<div class="col-4"> <p class="fs-6">Products</p></div>
				<div class="col-2"> <p class="fs-6">Price</p></div>
				<div class="col-2"> <p class="fs-6">Quantity</p></div>
				<div class="col-2"> <p class="fs-6">Total</p></div>
				<div class="col-2"> <p class="fs-6">Actions</p></div>	
			</div>
		</div>
			<?php 
				include "includes/conn.php";

					$sql= "SELECT sh.shop_name
					 	FROM shop sh
					 	JOIN items i
					 	on i.shop_id= sh.shop_id
					 	JOIN cart c
					 	on c.item_id= i.item_id
					 	GROUP BY sh.shop_name;";

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
					foreach ($arr as $key => $val) {
						$shop = $val['shop_name'];

						
							echo "<div class='items'>";
							
							echo "<div class='col-12 shopname' align='left' style='background-color:#30f2e8;'><b>". $val['shop_name']."</b></div>";

							
							$sql= "SELECT c.cart_id, i.item_img, i.item_name, p.price_amt, SUM(c.item_qty) as total_qty, SUM(c.total_amt) as total_amt2
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
					foreach ($arr as $key => $value) {
						echo "<form action='' method='POST'>";

						echo "<div class='row cartitems'>";
							echo "<div class='col-4 pr'>";
								echo "<div class='img-box'>";
									echo "<img src='items/".$value['item_img']."'>";
								echo "</div>";
								echo "<p>".$value['item_name']."</p>";
							echo "</div>";

							echo "<div class='col-2'> P".$value['price_amt'].".00</div>";
							echo "<div class='col-2'>".$value['total_qty']."</div>";			
							echo "<div class='col-2'>P".$value['total_amt2']."</div>";	

							echo "<div class='col-2 actions'>";		
								echo "<button class='btn btn-outline-danger' name='submit'><i class='bi bi-trash'></i></button>";
								echo "<button class='btn btn-outline-info' name='submit'> Buy</button>";
								echo "</form>";			
							echo "</div>";			
						echo "</div>";
						echo "<hr>";
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


