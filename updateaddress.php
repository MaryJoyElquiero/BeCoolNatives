<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Address</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/updateaddress.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
<?php include "custnav.php";
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
	header("Location:login.php?error=1");
	exit();
}
include "custnav.php";?>

<div class="container-fluid">
	
	<div class="updateaddress">
		<div class="box">

	<?php 
	include_once "includes/conn.php";

	

	$sql="SELECT ac.acc_id, ac.province, ac.city, ac.brgy, ac.add_details 
			FROM accinfo ac
			JOIN accounts a
			ON ac.acc_id=a.acc_id 
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

	?>
		

			<div class="title">Update Address</div>
			
		<form action="includes/updateadd.php" method="POST">
			<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">Province:</div>
					<div class="text">
						<input type="text" name="province" value="<?php echo $val['province'];  ?>" placeholder="Province" autofocus>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">City:</div>
					<div class="text">
						<input type="text" name="city" value="<?php echo $val['city'];  ?>" placeholder="City">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">Barangay:</div>
					<div class="text">
						<input type="text" name="brgy" value="<?php echo $val['brgy'];  ?>" placeholder="Barangay">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">Address Details</div>
					<div class="text">
						<input type="text" name="add_details" value="<?php echo $val['add_details'];  ?>" placeholder="Address Details">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="savebtn">
				<div class="info">
					 <?php if (isset($_GET['id'])) {
						$item_id=$_GET['id'];
						echo "<input type='hidden' name='item_id' value='" .$item_id. "'>";
					}
					?>
					<input type="hidden" name="acc_id" value="<?php echo $val['acc_id'];  ?>">
					<button type="submit" name="save"> Save </button>
				</div>
			</div>
		</div>
		</div>
	</form>	
	</div>
</div>


<?php

}
?>





<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>