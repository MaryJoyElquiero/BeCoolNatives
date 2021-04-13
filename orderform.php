<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/orderform.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>ORDER FORM</title>
</head>
<body>
<?php 
	if (isset($_POST['buy'])) {
		 include "custnav.php";
		$acc_id=htmlentities($_POST['acc_id']);
		$item_id=htmlentities($_POST['item_id']);
		$item_img=htmlentities($_POST['item_img']);
		$item_name=htmlentities($_POST['item_name']);
		$item_price=htmlentities($_POST['item_price']);
		$order_qty=htmlentities($_POST['order_qty']);
		$order_total=htmlentities($_POST['order_total']);
			?>
<div class="container-fluid">
<div class="orders">
	<div class="row">
		<div class="col-12" align="center">
			
				<p class="fs-3">Order Form</p>
				
		</div>
	</div>
	<form action="includes/placeorder.php" method="POST">
	<div class="order-box">
		<div class="img-box">
			<?php echo "<img src='items/".$item_img."'>"; ?>
		</div>
		<div class="order-form">
				<div class="details">
						<div class="label">
							<p>Item Name:</p>
							<p>Item Price:</p>
							<p>Quantity:</p>
							<p>Total Amount:</p>

						</div>
						<div class="itemdetails">
							<p > <?php echo $item_name ?></p>
							<p> P<?php echo $item_price ?></p>
							<p > <?php echo $order_qty ?></p>
							<p class="order_total">
								P<?php echo $order_total ?>
							</p>
						</div>
				</div>
				<div class="placeorder">
						<?php
										echo "<input type='hidden' name='acc_id' value='". $acc_id. "'>";
										echo "<input type='hidden' name='item_id' value='". $item_id. "'>";
										echo "<input type='hidden' name='item_price' value='". $item_price. "'>";
										echo "<input type='hidden' name='order_qty' value='". $order_qty."'>";
										echo "<input type='hidden' name='order_total' value='". $order_total. "'>";
										
						?>
					
						<button class="btn btn-outline-danger" name="cancel"> Cancel</button>
						<button class="btn btn-outline-danger" name="placeorder"> Place Order</button>
				</div>

		</div>
		</div>

</form>

<?php
}
else{
	header("Location:cart.php");
	exit();
}
?>


</div>
</div>


<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
