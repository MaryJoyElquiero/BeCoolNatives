<?php
session_start();

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}


 ?>
<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/seller_dashboard.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>DASHBOARD</title>
</head>
<body>

<?php include "sellernav.php";
	  include "includes/conn.php"; 


	  $sql="SELECT sh.shop_id from shop sh
						JOIN accounts ac
						ON sh.acc_id=ac.acc_id
						WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}';";

	
					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:seller_dashboard.php?error=ConnectionFailed1");
					exit();

					}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
				
					foreach ($arr as $key => $val) {
						$shop_id = $val['shop_id']; 

						?>

<div class="container">


	

	<div class="dashboard">

		
		<a href="sellerreport.php">
		<div class="box" style="background-color: #fcba03;">
			<div class="content">
			<div class="number">
				<?php 
						$sql="SELECT SUM(o.order_total) as total, SUM(o.order_qty) as total_qty
						FROM orders o
							JOIN items i
							on o.item_id= i.item_id
							WHERE i.shop_id='$shop_id'
							AND o.order_status!='Cancelled';";

							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:seller_dashboard.php?error=ConnectionFailed2");
							exit();

							}
							mysqli_stmt_execute($stmt);
							$result=mysqli_Stmt_get_result($stmt);
							$arr= array();
							while ($row=mysqli_fetch_assoc($result)) {
							array_push($arr, $row);
							}
						
							foreach ($arr as $key => $val) {

								echo "Php ". number_format($val['total'],2);					

				?>

			</div>
			<div class="label"> Total Sales </div>
			</div>
		</div>
	</a>

		<a href="sellerreport.php">
		<div class="box" style="background-color: #29a3a3;">
			<div class="content">
			<div class="number">
				
				<?php
								if ($val['total_qty']==null) {
									echo "0";
								}
								else{

								echo $val['total_qty'];
							}
							}
				 ?>
			</div>
			<div class="label"> Total Orders </div>
			</div>
		</div>
		</a>

<a href="products.php">
		<div class="box" style="background-color: #5aed92;">
			<div class="content">
			<div class="number">
				<?php 
				$sql="SELECT count(*)  FROM items
							WHERE shop_id='$shop_id';";

					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);

								echo $row[0];
					
 				?>
			</div>
			<div class="label"> Total Products</div>
			</div>
		</div>
</a>

		<div class="box" style="background-color: #46afdb;">
			<div class="content">
			<div class="number">
				<?php 
				$sql="SELECT count(DISTINCT o.acc_id) 
							FROM orders o
							JOIN items i
							ON o.item_id= i.item_id
							WHERE shop_id='$shop_id';";

					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);

								echo $row[0];
					
 				?>
			</div>
			<div class="label"> Total Customers </div>
			</div>
		</div>


<?php } ?>
	</div>

</div>



<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>



</body>
</html>
