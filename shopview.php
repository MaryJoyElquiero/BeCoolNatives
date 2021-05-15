<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/shopview.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>SHOP</title>
</head>
<body>


<?php 

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}

 ?>

<?php include "sellernav.php" ?>
<div class="container-fluid">
<div class="items">


	<div class="banner">
	<div class="row">
		<div class="col-6" align="left">
			<div class="shopname">
					<div class="icon"><i class="bi bi-shop"></i></div>				
					<div class="text">
						
						<?php 
						include_once "includes/conn.php";
						$sql="SELECT sh.shop_name
								FROM shop sh
								JOIN accounts a
								ON sh.acc_id=a.acc_id 
								WHERE a.email='{$_SESSION['email']}'
								AND a.password='{$_SESSION['password']}';";

						$stmt= mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location:account.php?error= Connection Failed");
								exit();
							}

							mysqli_stmt_execute($stmt);
							$result=mysqli_Stmt_get_result($stmt);
							$arr= array();
							while ($row=mysqli_fetch_assoc($result)) {
								array_push($arr, $row);
							}
							foreach ($arr as $key => $val) {
								echo $val['shop_name'];
							}

						?>
					 

					</div>
					<div class="edit"><a href="editshop.php">Edit Shop Name</a></div>
							
			</div>

		</div>
			

		<div class="col-6 search" align="right">
			<form action="shopview.php" method="GET">
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
		<form method="POST" action="shopview.php" class="category">
		<button type="submit" name="categoryAll">All</button>
		</form>
		<?php 
		include "includes/conn.php";

		$sql= "SELECT * FROM category WHERE cat_status ='Active';";

		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:shopindex.php?error=1");
			exit();

		}
		mysqli_stmt_execute($stmt);
		$result=mysqli_Stmt_get_result($stmt);
		$arr= array();
		while ($row=mysqli_fetch_assoc($result)) {
			array_push($arr, $row);
		}
		foreach ($arr as $key => $val) {
			
			echo "<form method='POST' action='shopview.php' class='category'>";
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
				echo "<p class='text-danger' align='center'>Failed to delete</p>";
				break;
			case 3:
				echo "<p class='text-success' align='center'>Item deleted</p>";
				break;
			case 4:
				echo "<p class='text-success' align='center'>Saved</p>";
				break;
			case 5:
				echo "<p class='text-danger' align='center'>Not Saved</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}

		include "includes/conn.php";
	
		if (isset($_POST['category'])) {
		$category=htmlentities($_POST['cat_desc']);
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									JOIN accounts a
									ON a.acc_id= sh.acc_id								
									WHERE a.email='{$_SESSION['email']}'
									AND a.password='{$_SESSION['password']}'
									AND i.item_stat='Active'
									AND ct.cat_desc='$category';";
		}
		elseif(isset($_GET['search'])) {
			$searchkey=htmlentities($_GET['searchkey']);
			$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									JOIN accounts a
									WHERE a.email='{$_SESSION['email']}'
									AND a.password='{$_SESSION['password']}'
									AND i.item_name LIKE '$searchkey%'
									AND i.item_stat='Active';
									";
		}

		elseif(isset($_POST['categoryAll'])) {
			$sql= "SELECT i.item_id, p.price_id, i.item_img, i.item_name, p.price_amt, ct.cat_desc
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id= sh.shop_id
									JOIN accounts a
									ON a.acc_id= sh.acc_id								
									WHERE a.email='{$_SESSION['email']}'
									AND a.password='{$_SESSION['password']}'
									AND i.item_stat='Active';";
		}

		else{
		$sql= "SELECT i.item_id,p.price_id, i.item_img, i.item_name,p.price_amt
									FROM items i
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id=sh.shop_id
									JOIN accounts a
									ON a.acc_id=sh.acc_id								
									WHERE a.email='{$_SESSION['email']}'
									AND a.password='{$_SESSION['password']}'
									AND i.item_stat='Active';";
		}
		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:shopview.php?error=Connection Failed");
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


	
			echo "<div class='content'>";
		
						echo "<div class='img-box'>";
						echo "<img src='items/".$val['item_img']."' >";
						echo "<div class='details'>";
						echo "<p>".$val['item_name']."</p>";
						echo "<div class='price'>Php".number_format($val['price_amt'],2)."</div>";
						?>
						<div class="actions">
							<form action="includes/deleteItem.php" method="POST">
								<input type="hidden" name="item_id" value=" <?php echo $val['item_id']; ?>">
								<button name="delete1" type="submit">
									<h4><i class="bi bi-trash"></i></h4>
								</button>
							</form>
							<a href="editItem.php?id=<?php echo $val['item_id'];?>">
							<button name="edit" type="submit">
								<h4><i class="bi bi-pencil-square"></i></h4>
							</button>
							</a>
						</div>
					
						<?php
						echo "</div>";
						echo "</div>";
			echo "</div>";
	
		}

		 ?>
</div>


</div>



<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>



</script>
</body>
</html>





