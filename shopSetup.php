<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>SHOP SET UP</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/editprofile.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
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
	<form action="includes/addshop.php" method="POST">

			<div class="row">
			<div class="header">
				<div class="info"> 
					<div class="text">
						SET UP SHOP
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-shop"></i></div>
				<div class="info"> 
					<div class="label">Shop Name:</div>
					<div class="text">
						<input type="text" name="shop_name" placeholder="Shop Name" required="" autofocus>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="savebtn">
				<div class="info"> 
					<button type="submit" name="save"> Save </button>
				</div>
			</div>
		</div>
		
</form>
</div>
</div>



<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>