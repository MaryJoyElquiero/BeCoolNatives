<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>ACCOUNT</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>HOME</title>
</head>
<body>

<?php include "custnav.php";
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
	header("Location:login.php?error=1");
	exit();
}

?>
<div class="container">
<div class="account">

	<?php 
	include_once "includes/conn.php";
	$sql="SELECT ac.acc_cn, ac.acc_age, ac.acc_gender, ac.acc_contact, ac.province, ac.city, ac.brgy, ac.add_details 
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


	
		<div class="row">	
			
				<div class="acc-header">
					<div class="header-icon"><i class="bi bi-person-circle"></i></div>
					<div class="accountname">				
						<div class="name">
						 <?php echo $val['acc_cn']; ?>
						</div>

						<div class="editprofile">
						 <a href="editprofile.php"><button> Edit Profile</button></a>	
						 		
						</div>


					</div>
					
				</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">Address:</div>
					<div class="text"> <?php echo $val['province'] ." ," . $val['city'] ." ,". $val['brgy'] ." ,". $val['add_details']; ?></div>
				</div>
				<div class="editadd">
						<button>Edit Address</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-telephone"></i></div>
				<div class="info"> 
					<div class="label">Phone Number:</div>
					<div class="text"> <?php echo $val['acc_contact']; ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-person-check"></i></div>
				<div class="info"> 
					<div class="label">Age:</div>
					<div class="text"> <?php echo $val['acc_age']; ?></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-person-check""></i></div>
				<div class="info"> 
					<div class="label">Gender:</div>
					<div class="text"> <?php echo $val['acc_gender']; ?></div>
				</div>
			</div>
		</div>
		

</div>
</div>


<?php } ?>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>