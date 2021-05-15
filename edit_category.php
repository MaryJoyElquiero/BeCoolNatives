<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT Category</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/editItem.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>

<?php include "adminnav.php";
if (!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_pass'])) {
	header("Location:login.php?error=1");
	exit();
}

?>
<div class="container">
<div class="account">
	<form action="includes/editcategory.php" method="POST">

	<?php 
	include_once "includes/conn.php";
if (isset($_GET['id'])) {
	$cat_id=htmlentities($_GET['id']);
}


	$sql="SELECT cat_id, cat_desc,cat_status from category
									where
									 cat_id='$cat_id';";

	$stmt= mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:edit_category.php?error=Connection Failed");
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
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Category Name:</div>
					<div class="text">
						<input type="text" name="cat_desc" value="<?php echo $val['cat_desc'];  ?>" placeholder="Category Name" required autofocus>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-tag"></i></div>
				<div class="info"> 
					<div class="label">Status:</div>
					<div class="text">

						 <select class="form-select" name="cat_status" required>
	                      <option selected value="<?php echo $val['cat_status'];?>"><?php echo $val['cat_status'];?></option>
									<?php 
									if ($val['cat_status']=="Active") {
									 	echo "<option value='InActive'>InActive</option>";
									 } 
									 else{
									 	echo "<option value='Active'>Active</option>";
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
				<input type="hidden" name="cat_id" value="<?php echo $val['cat_id']; ?>"> 
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