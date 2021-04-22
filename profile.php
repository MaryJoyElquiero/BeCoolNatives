<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>ACCOUNT</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/editprofile.css">
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
	<form action="includes/addprofile.php" method="POST">

			<div class="row">
			<div class="header">
				<div class="info"> 
					<div class="text">
						SET UP PROFILE
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-person"></i></div>
				<div class="info"> 
					<div class="label">Full Name:</div>
					<div class="text">
						<input type="text" name="cn" placeholder="Full Name" autofocus>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="add-info">
				<div class="icon"><i class="bi bi-geo"></i></div>
				<div class="info"> 
					<div class="label">Address:</div>
					<div class="address">

						<input type="text" name="province" placeholder="Province">
						
						<input type="text" name="city"  placeholder="City">
						
						<input type="text" name="brgy" Placeholder="Baranggay">
						
						<input type="text" name="add_details" placeholder="Address Details">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-telephone"></i></div>
				<div class="info"> 
					<div class="label">Phone Number:</div>
					<div class="text">
						<input type="text" name="pn" placeholder="Phone Number">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-person-check"></i></div>
				<div class="info"> 
					<div class="label">Age:</div>
					<div class="text">
						<input type="number" name="age" placeholder="Age">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="acc-info">
				<div class="icon"><i class="bi bi-person-check""></i></div>
				<div class="info"> 
					<div class="label">Gender:</div>
					<div class="text">
						 <select class="form-select" name="gender" required="">
	                      <option selected>Select</option>
						  <option value="Male">Male</option>
						  <option value="Female">Female</option> 
						</select>    
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
