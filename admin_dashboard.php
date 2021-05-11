<?php
session_start();

if (!isset($_SESSION['admin_pass']) || !isset($_SESSION['admin_email'])) {
	header("Location:admin_login.php?error=1");
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

<?php include "adminnav.php";
	  include "includes/conn.php"; ?>

<div class="container">
	

	<div class="dashboard">
		
		<a href="admin_customers.php">
		<div class="box" style="background-color: #fcba03;">
			<div class="content">
			<div class="number">
				<?php 
							$sql="SELECT count(*)  FROM accounts;";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:seller_dashboard.php?error=ConnectionFailed2");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];


											

				?>

			</div>
			<div class="label"> Customers </div>
			</div>
		</div>
	</a>

		<a href="admin_sellers.php">
		<div class="box" style="background-color: #29a3a3;">
			<div class="content">
			<div class="number">
				<?php
				$sql="SELECT count(*)  FROM shop;";

					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);

								echo $row[0];
					
				 ?>
			</div>
			<div class="label"> Shop/Sellers </div>
			</div>
		</div>
		</a>

<a href="admin_products.php">
		<div class="box" style="background-color: #5aed92;">
			<div class="content">
			<div class="number">
				<?php 
				$sql="SELECT count(*)  FROM items;";

					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);

								echo $row[0];
					
 				?>
			</div>
			<div class="label"> Products</div>
			</div>
		</div>
</a>

<a href="admin_requests.php">

		<div class="box" style="background-color: #46afdb;">
			<div class="content">
			<div class="number">
				<?php 
					
					$sql="SELECT count(*)  FROM items WHERE item_stat='Pending';";


					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);

					echo $row[0];
					
 				?>
			</div>
			<div class="label"> Requests </div>
			</div>
		</div>
</a>
	</div>

</div>



<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>



</body>
</html>