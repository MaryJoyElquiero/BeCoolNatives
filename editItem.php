<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT ITEM</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/editItem.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>HOME</title>
</head>
<body>

<?php include "sellernav.php";
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
	header("Location:login.php?error=1");
	exit();
}

?>
<div class="container">
<div class="account">
	<form action="includes/updateItem.php" method="POST" enctype="multipart/form-data">

	<?php 
	include_once "includes/conn.php";
if (isset($_GET['id'])) {
	$item_id=htmlentities($_GET['id']);
}


	$sql="SELECT i.item_id,i.item_img,i.item_name,i.item_short_code,p.price_amt,i.cat_id,ct.cat_desc, i.item_stat
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									where
									 i.item_id='$item_id';";

	$stmt= mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:account.php?error=Connection Failed");
			exit();
		}

		mysqli_stmt_execute($stmt);
		$result=mysqli_Stmt_get_result($stmt);
		$arr= array();
		while ($row=mysqli_fetch_assoc($result)) {
			array_push($arr, $row);
		}
		foreach ($arr as $key => $val) {

	?>
		
			<?php 

			if (isset($_GET['error'])) {
		switch ($_GET['error']) {
			case 1:
				echo "<p class='text-danger'>Not Saved</p>";
				break;
			case 2:
				echo "<p class='text-success'>Saved</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}
?>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-image"></i></div>
				<div class="info"> 
					<div class="label">Item Image:</div>
					<div class="img-box">
						<img src="items/<?php echo $val['item_img'];  ?>">
					</div>
					<div class="text">
						<input type="file" name="item_img">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Item Name:</div>
					<div class="text">
						<input type="text" name="item_name" value="<?php echo $val['item_name'];  ?>" placeholder="Item Name" required autofocus>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Item Short Code:</div>
					<div class="text">
						<input type="text" name="item_sc" value="<?php echo $val['item_short_code'];  ?>" placeholder="Item Short Code" required>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Price:</div>
					<div class="text">
						<input type="number" name="price_amt" value="<?php echo $val['price_amt'];  ?>" placeholder="Item Price" required>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Category:</div>
					<div class="text">

						 <select class="form-select" name="cat_desc" required>
	                      <option selected value="<?php echo $val['cat_id'];?>"><?php echo $val['cat_desc'];?></option>
								<?php 
									include "includes/conn.php";

									$sql= "SELECT * FROM category WHERE cat_status ='A';";

									$stmt= mysqli_stmt_init($conn);
									if(!mysqli_stmt_prepare($stmt,$sql)) {
										header("Location:editItem.php?error=1");
										exit();

									}
									mysqli_stmt_execute($stmt);
									$result=mysqli_Stmt_get_result($stmt);
									$arr= array();
									while ($row=mysqli_fetch_assoc($result)) {
										echo "<option value='". $row['cat_id']."'>".$row['cat_desc']."</option>";
									}
?>
						</select>    
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Item Status:</div>
					<div class="text">

						 <select class="form-select" name="item_stat" <?php  
	                      		if ($val['item_stat']=="Pending") {
	                      			echo "disabled";
	                      		}
	                      ?> required >
	                      <option selected value="<?php echo $val['item_stat'];?>"><?php echo $val['item_stat'];?></option>
	                      <?php  
	                      		if ($val['item_stat']=="Discontinued") {
	                      			echo "<option value='Active'>Active</option>";
	                      		}
	                      		if ($val['item_stat']=="Active") {
	                      			echo "<option value='Discontinued'>Discontinue</option>";
	                      		}
	                      		
	                      ?>
	                    
	                  
						</select>    
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="savebtn">
				<div class="info">
				<input type="hidden" name="item_id" value="<?php echo $val['item_id']; ?>"> 
					<button type="submit" name="save"> Save </button>
				</div>
			</div>
		</div>
		
</form>
</div>
</div>


<?php } ?>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
