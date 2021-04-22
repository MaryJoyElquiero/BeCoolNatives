<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>MYORDERS</title>
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
<div class="orders">
	<div class="row">
		<div class="col-md-7 col-12" align="left">
			<div class="my-md-2">
				<p class="fs-3">My Orders</p>
			</div>
			
		</div>
		<div class="col-md-5 col-12" align="right">
			<form action="completed.php" method="GET">
			<div class="my-md-2">
				<div class="input-group">
					<input class="form-control" type="text" name="searchkey" placeholder="Search Completed Orders">
					<button class="btn btn-outline-dark" name="search"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</form>
		</div>	
	</div>


<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link " href="myorders.php">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="topay.php"> To Pay </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="toship.php"> To Ship </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="torecieve.php"> To Recieve</a>
  </li>
    <li class="nav-item">
    <a class="nav-link active"  style="background-color:#29a3a3;" aria-current="page" href="completed.php"> Completed</a>
  </li>
 
</ul>



<?php 

include "includes/conn.php";

if (isset($_GET['search'])) {
	$searchkey=$_GET['searchkey'];

	 $sql="SELECT o.order_date
					 	FROM orders o
					 	JOIN items i
					 	on i.item_id= o.item_id
					 	JOIN accounts ac
					 	ON o.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
						AND i.item_name LIKE '$searchkey%'
						AND o.order_status='Completed'
					 	GROUP BY o.order_date
					 	ORDER BY o.order_date
					 	DESC;";


}
else{

		$sql="SELECT o.order_date
					 	FROM orders o
					 	JOIN items i
					 	on i.item_id= o.item_id
					 	JOIN accounts ac
					 	ON o.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
						AND o.order_status='Completed'
					 	GROUP BY o.order_date
					 	ORDER BY o.order_date
					 	DESC;";

}
					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location: myorders.php?error= Connection Failed");
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
						$order_date = $val['order_date'];

if (isset($_GET['search'])) {
	$searchkey=$_GET['searchkey'];


						$sql2="SELECT sh.shop_name
					 	FROM shop sh
					 	JOIN items i
					 	on i.shop_id= sh.shop_id
					 	JOIN orders o
					 	on o.item_id= i.item_id
					 	JOIN accounts ac
					 	ON o.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
						AND o.order_date='$order_date'
						AND i.item_name LIKE '$searchkey%'
						AND o.order_status='Completed'
					 	GROUP BY sh.shop_name;";
}
else{

						$sql2="SELECT sh.shop_name
					 	FROM shop sh
					 	JOIN items i
					 	on i.shop_id= sh.shop_id
					 	JOIN orders o
					 	on o.item_id= i.item_id
					 	JOIN accounts ac
					 	ON o.acc_id= ac.acc_id
					 	WHERE ac.email='{$_SESSION['email']}'
						AND ac.password='{$_SESSION['password']}'
						AND o.order_date='$order_date'
						AND o.order_status='Completed'
					 	GROUP BY sh.shop_name;";
}
					 	$stmt2= mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt2,$sql2)) {
						header("Location: myorders.php?error= Connection Failed");
						exit();

						}
					mysqli_stmt_execute($stmt2);
					$result=mysqli_Stmt_get_result($stmt2);
					$arr2= array();
					while ($row2=mysqli_fetch_assoc($result)) {
					array_push($arr2, $row2);
					}
					foreach ($arr2 as $key => $val) {
						$shop = $val['shop_name'];


	?>

<div class="order-items">
	<div class="row">
		<div class="col-12 shop_name">
			<p><?php echo $shop; ?></p>
		</div>	
	</div>
	<hr>

		<?php 
if (isset($_GET['search'])) {
	$searchkey=$_GET['searchkey'];
	$sql= "SELECT i.item_img, i.item_name, o.item_price, o.order_qty,o.order_total,o.order_date, o.order_status,o.billing_info
								FROM orders o
								 JOIN items i
							 	 ON o.item_id= i.item_id
							  	JOIN shop sh
								  ON i.shop_id= sh.shop_id
								JOIN accounts ac
								  ON ac.acc_id=o.acc_id
							 	 WHERE sh.shop_name = '$shop'
							 	 AND o.order_date='$order_date'
							 	 AND ac.email='{$_SESSION['email']}'
							 	 AND i.item_name LIKE '$searchkey%'
							 	 AND o.order_status='Completed'
							 	 AND ac.password='{$_SESSION['password']}';";

}
else{
		$sql= "SELECT i.item_img, i.item_name, o.item_price, o.order_qty,o.order_total,o.order_date, o.order_status,o.billing_info
								FROM orders o
								 JOIN items i
							 	 ON o.item_id= i.item_id
							  	JOIN shop sh
								  ON i.shop_id= sh.shop_id
								JOIN accounts ac
								  ON ac.acc_id=o.acc_id
							 	 WHERE sh.shop_name = '$shop'
							 	 AND o.order_date='$order_date'
							 	 AND o.order_status='Completed'
							 	 AND ac.email='{$_SESSION['email']}'
							 	 AND ac.password='{$_SESSION['password']}';";
}
							  	$stmt= mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location: myorders.php?error= Connection Failed");
								exit();

								}
					mysqli_stmt_execute($stmt);
					$result=mysqli_Stmt_get_result($stmt);
					$arr= array();
					while ($row=mysqli_fetch_assoc($result)) {
					array_push($arr, $row);
					}
					foreach ($arr as $key => $value) {


		?>

	<div class="row">
		<div class="col-2">
			<div class="img-box">
				<?php echo "<img src='items/" . $value['item_img']."'>" ; ?>
			</div>
		</div>
		<div class="col-5">
			<div class="details">
				
				<p class="label"> Placed Order: <?php  echo $value['order_date'];?></p>
				<p class="itemname"> <?php  echo $value['item_name'];?></p>
				<p>Php <?php  echo number_format($value['item_price'],2).  " x " .$value['order_qty'];?></p>
				<p> <?php  echo $value['billing_info'];?></p>
			</div>
		</div>
		<div class="col-3">
			<div class="order_total">
				
				<p class="label"> Total: </p>
				<p class="order_total"> Php <?php  echo number_format($value['order_total'],2);?></p>
				<p> <?php  echo $value['order_status'];?></p>
				<button class="btn btn-outline-danger" name="cancel"> Cancel Order</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="order_status">
				
			</div>
		</div>
	</div>



<hr>
<?php } ?>
</div>

<?php 


}
}

?>
</div>
</div>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>


