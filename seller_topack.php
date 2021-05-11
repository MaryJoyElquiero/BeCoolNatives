
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>ORDERS</title>
</head>
<body>
<?php 

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}

 ?>

<?php include "sellernav.php" ?>
<div class="container">
<div class="orders">
	<div class="row">
		<div class="col-md-7 col-12" align="left">
			<div class="my-md-2">
				<p class="fs-3">Orders</p>
			</div>
			
		</div>
		<div class="col-md-5 col-12" align="right">
			<form action="orders.php" method="GET">
			<div class="my-md-2">
				<div class="input-group">
					<input class="searchkey" type="text" name="searchkey" placeholder="Search Orders">
					<button class="searchbtn" name="search"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</form>
		</div>	
	</div>


<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link"  href="orders.php">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active"  style="background-color:#29a3a3;" aria-current="page" href="seller_topack.php"> To Pack </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="seller_toship.php"> To Ship </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="seller_shipped.php"> Shipped</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="seller_completed.php"> Completed</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="seller_cancelled.php"> Cancelled</a>
  </li>
 
 
</ul>




<?php 

include "includes/conn.php";


if (isset($_GET['search'])) {
	$searchkey=$_GET['searchkey'];
	

}

	$sql="SELECT sh.shop_id from shop sh
	JOIN accounts ac
	ON sh.acc_id=ac.acc_id
	WHERE ac.email='{$_SESSION['email']}'
	AND ac.password='{$_SESSION['password']}';";

	
				$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:orders.php?error=ConnectionFailed1");
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
	}

						if (isset($_GET['search'])) {
						$searchkey=$_GET['searchkey'];

						$sql="SELECT o.order_date
					 	FROM orders o
					 	JOIN items i
					 	on i.item_id= o.item_id
					 	JOIN shop sh
					 	ON i.shop_id= sh.shop_id
					 	WHERE sh.shop_id ='$shop_id'
					 	AND i.item_name LIKE '$searchkey%'
					 	AND o.order_status ='To Pay'
					 	GROUP BY o.order_date
					 	ORDER BY o.order_date
					 	DESC;";
					 }
					 else{
					 	$sql="SELECT o.order_date
					 	FROM orders o
					 	JOIN items i
					 	on i.item_id= o.item_id
					 	JOIN shop sh
					 	ON i.shop_id= sh.shop_id
					 	WHERE sh.shop_id ='$shop_id'
					 	AND o.order_status ='To Pay'
					 	GROUP BY o.order_date
					 	ORDER BY o.order_date
					 	DESC;";

					 }

					$stmt= mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:orders.php?error= Connection Failed2");
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

						$sql="SELECT o.order_id,i.item_img, o.order_date, i.item_name,o.order_qty, ac.acc_cn, o.billing_info,o.item_price,o.order_total, o.order_status
						FROM orders o
						JOIN items i 
						ON o.item_id= i.item_id
						JOIN accinfo ac
						ON o.acc_id=ac.acc_id
						WHERE o.order_date='$order_date'
						AND o.order_status ='To Pay'
						AND i.item_name LIKE '$searchkey%';
						";
						}
						else{
						$sql="SELECT o.order_id,i.item_img, o.order_date, i.item_name,o.order_qty, ac.acc_cn, o.billing_info,o.item_price,o.order_total, o.order_status
						FROM orders o
						JOIN items i 
						ON o.item_id= i.item_id
						JOIN accinfo ac
						ON o.acc_id=ac.acc_id
						WHERE o.order_date='$order_date'
						AND o.order_status ='To Pay';";
						}


	?>

<div class="order-items">		

<?php 


							  	$stmt= mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location:orders.php?error= Connection Failed");
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

	<div class="row items">
		<div class="col-2">
			<div class="img-box">
				<?php echo "<img src='items/" . $value['item_img']."'>" ; ?>
			</div>
		</div>
		<div class="col-5">
			<div class="details">	
				<p class="label"> Placed Order: <?php  echo $value['order_date'];?></p>
				<p class="itemname"> <?php  echo $value['order_qty'] ." x ". $value['item_name'];?></p>
				<p> Customer Name: <?php  echo $value['acc_cn'];?></p>
				<p> Shipping Address: <?php  echo $value['billing_info'];?></p>
			</div>
		</div>
		<div class="col-3">
			<div class="order_total">
				
				<p>P <?php  echo number_format($value['item_price'],2).  " x " .$value['order_qty'];?></p>
				<p class="order_total"> P <?php  echo number_format($value['order_total'],2);?></p>
				<p> <?php  if($value['order_status']=="To Pay"){

					echo "To Pack";
				};?></p>
				<form action="includes/orderstatus.php" method="POST">
					<input type="hidden" name="order_id" value="<?php  echo $value['order_id'];?>">
				<button class="btn btn-outline-success" name="packed">Packed</button>
				</form>
			</div>
		</div>

	</div>
	
	

<hr>
<?php } ?>
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





