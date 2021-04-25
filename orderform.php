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
	<?php include "custnav.php";?>
<div class="container-fluid">
<div class="orders">
	<div class="row">
		<div class="col-12" align="center">
			
				<p class="fs-3">Order Form</p>
				
		</div>
	</div>

<?php 

			include_once "includes/conn.php";

		if (isset($_GET['id'])) {
			$item_id=$_GET['id'];
		}
		else{
			header("Location:cart.php");
			exit;
		}

			
							$sql= "SELECT ac.acc_id, aci.acc_cn, c.item_id, i.item_img, i.item_name, p.price_amt, SUM(c.item_qty) as order_qty, SUM(c.total_amt) as order_total, aci.province, aci.city, aci.brgy, aci.add_details
								FROM cart c
								 JOIN items i
							 	 ON c.item_id= i.item_id
							 	 JOIN price p
							 	 ON i.item_id=p.item_id
								JOIN accounts ac
								  ON ac.acc_id=c.acc_id
								JOIN accinfo aci
								ON c.acc_id= aci.acc_id
								WHERE c.item_id='$item_id'
							 	 AND ac.email='{$_SESSION['email']}'
							 	 AND ac.password='{$_SESSION['password']}'
							 	 GROUP BY i.item_name;";
					

					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location: cart.php?error=1");
					exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					if (empty($arr)) {
						header("Location:cart.php");
						exit();
					}

					foreach ($arr as $key => $value) {


?>
	
	<div class="order-box">
		<div class="reciever">
			<div class="label"> Reciever:</div>
			 <div class="info">	<?php echo $value['acc_cn'];?> </div>

		</div>

		<div class="address">
				<div class="reciever">
					<div class="label"> Address :</div>
					<div class="info"><?php echo $value['province'].", ". $value['city']. ", ". $value['brgy'].", " .$value['add_details']; ?></div>		
				</div>
				<div class="editadd">
				    <?php echo "<a href='updateaddress.php?id=".$value['item_id']."'><button class='btn btn-outline-danger' name='editadd'>Change Address</button></a>";?>
				</div>
		</div>
 <hr>
		<div class="order-details">
		<div class="img-box">
		<?php echo "<img src ='items/" .$value['item_img']. "'>" ; ?>
		</div>

		
		<div class="details">
						<div class="itemdetails">

							<p class="item_name"><?php echo $value['item_name'];?></p>
							<p>Php <?php echo number_format($value['price_amt'],2);?> x <?php echo $value['order_qty'];?></p>
							<p class="order_total">= Php
								<?php echo number_format($value['order_total'],2);?>
							</p>
						</div>
		</div>

		</div>
		<form action="includes/placeorder.php" method="POST">
				<div class="placeorder">
						<?php


										echo "<input type='hidden' name='acc_id' value='". $value['acc_id']. "'>";
										echo "<input type='hidden' name='item_id' value='". $value['item_id']. "'>";
										echo "<input type='hidden' name='item_price' value='". $value['price_amt']. "'>";
										echo "<input type='hidden' name='order_qty' value='". $value['order_qty']."'>";
										echo "<input type='hidden' name='order_total' value='". $value['order_total']. "'>";
										echo "<input type='hidden' name='billing_info' value='". $value['province']. ", ". $value['city'] ." ," .$value['brgy'] ." ," .$value['add_details']. "'>";
										
						?>
					
						<button class="btn btn-outline-danger" name="cancel"> Cancel</button>
						<button class="btn btn-outline-danger" name="placeorder"> Place Order</button>
				</div>
		</form>
		</div>



<?php 
}
?>
</div>
</div>


<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
