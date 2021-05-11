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
		
		if (isset($_GET['item_id'])&&isset($_GET['item_qty'])&&isset($_GET['total_amt'])&&isset($_GET['price_amt'])) {
							
							$sql="SELECT ac.acc_id, aci.acc_cn,aci.province, aci.city, aci.brgy, aci.add_details
								FROM accounts ac
								JOIN accinfo aci
								ON ac.acc_id= aci.acc_id
								WHERE ac.email='{$_SESSION['email']}'
							 	 AND ac.password='{$_SESSION['password']}'
							 	;";


					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:index.php?error=1");
					exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					if (empty($arr)) {
						header("Location:index.php?error=2");
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
				    <?php echo "<a href='updateaddress.php?item_id=".$_GET['item_id']."&&item_qty=".$_GET['item_qty']."&&total_amt=".$_GET['total_amt']."&&price_amt=".$_GET['price_amt']."'><button class='btn btn-outline-danger' name='editadd'>Change Address</button></a>";?>
				</div>
		</div>
 <hr>
		<div class="order-details">
		<div class="img-box">
		<?php 
		$sql="SELECT item_name, item_img FROM items WHERE item_id = '{$_GET['item_id']}';";


					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:index.php?error=1");
					exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					if (empty($arr)) {
						header("Location:index.php?error=2");
						exit();
					}

					foreach ($arr as $key => $val) {
										

		echo "<img src ='items/" .$val['item_img']. "'>" ; ?>
		</div>

		
		<div class="details">
						<div class="itemdetails">

							<p class="item_name"><?php echo $val['item_name'];
						?></p>
							<p>Php <?php echo number_format($_GET['price_amt'],2);?> x <?php echo $_GET['item_qty'];?></p>
							<p class="order_total">= Php
								<?php echo number_format($_GET['total_amt'],2);?>
							</p>
						</div>
		</div>

		</div>
		<form action="includes/placeorder.php" method="POST">
				<div class="placeorder">
						<?php


										echo "<input type='hidden' name='acc_id' value='". $value['acc_id']. "'>";
										echo "<input type='hidden' name='item_id' value='". $_GET['item_id']. "'>";
										echo "<input type='hidden' name='item_price' value='". $_GET['price_amt']. "'>";
										echo "<input type='hidden' name='order_qty' value='". $_GET['item_qty']."'>";
										echo "<input type='hidden' name='order_total' value='". $_GET['total_amt']. "'>";
										echo "<input type='hidden' name='billing_info' value='". $value['province']. ", ". $value['city'] ." ," .$value['brgy'] ." ," .$value['add_details']. "'>";
										
						?>
					
						<button class="btn btn-outline-danger" name="cancel"> Cancel</button>
						<button class="btn btn-outline-danger" name="placeorder"> Place Order</button>
				</div>
		</form>
		</div>



<?php 
}
}
}
else {
	header("Location: index.php");
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