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
<div class="container-fluid">
<div class="items">

<div class="banner">
	<div class="row">
		<div class="col-6" align="left">

				<div class="intro">
					<div class="logo"><img src="img/logo2.png"></div>
					<div class="intro-text">
						<div class="text">Bicol Native Products. </div>
						<div class="becool">
							<div class="be">Shop and Be</div>
							<div class="cool"> Cool!</div>
						</div>
					</div>
				</div>
			</div>

		<div class="col-6 search" align="right">
			<form action="index.php" method="GET">
			<div class="my-md-1">
				<div class="input-group">
					<input class="searchkey" type="text" name="searchkey" placeholder="Search Item">
					<button class="searchbtn" name="search"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</form>
		</div>		
</div>

</div>		

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
			case 3:
				echo "<p class='text-success' align='center'>Welcome to BeCool</p>";
				break;
			case 4:
				echo "<p class='text-success' align='center'>Logged In</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}

		include "includes/conn.php";
	
		if (isset($_POST['category'])) {
		$category=htmlentities($_POST['cat_desc']);
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc, sh.shop_name,i.shop_id
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									WHERE i.item_stat='Active'
									AND ct.cat_desc='$category';";
		}
		elseif(isset($_GET['search'])) {
			$searchkey=htmlentities($_GET['searchkey']);
			$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc, sh.shop_name,i.shop_id
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									WHERE i.item_stat='Active'
									AND i.item_name LIKE '$searchkey%';
									";
		}

		elseif(isset($_POST['categoryAll'])) {
			$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc, sh.shop_name,i.shop_id
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									WHERE i.item_stat='Active';";
		}

		else{
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name,p.price_amt, ct.cat_desc, sh.shop_name,i.shop_id
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
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
		if (empty($arr)) {
			echo "<div class='empty'>";
						echo "<p> <i class='bi bi-bag-x'></i> No items found  </p>";
						echo "</div>";
		}
		foreach ($arr as $key => $val) {

?>
	
			<div class="content">

				<form action="includes/addtocart.php" method="POST">
		
						<input type="hidden" name="item_id" value="<?php echo $val['item_id']; ?>">
						<input type="hidden" name="price_id" value="<?php echo $val['price_id']; ?>">
						<input type="hidden" name="price_amt" value="<?php echo $val['price_amt']; ?>">
						
						<a href="shop_page.php?shop_id=<?php echo $val['shop_id'];?>">
							<div class="shop_name">
							<i class="bi bi-shop"></i>
							<p> <?php echo $val['shop_name'];?></p>
							</div>
						</a>
						<div class="img-box">
						<img src="items/<?php echo $val['item_img'];?>">
						</div>
						<div class="details">
						
						<p><?php echo $val['item_name'];?> </p>

						<div class="price">Php <?php echo number_format($val['price_amt'],2); ?></div>

						<div class="itemqty">
							<input type="number" name="item_qty" placeholder="set quantity" required="">
						</div>
						<div class="actions">
							<button name="addtocartbtn" type="submit">
								<h4><i class="bi bi-cart-plus"></i></h4>
							</button>
							<button name="buynow" type="submit">Buy Now</button>
						</div>
					</div>
				</form>
			</div>
	<?php } ?>
	
</div>

</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>


</body>
</html>






