
<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		PROFILE
	</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
<?php 

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:signup.php?error=3");
	exit();
}

 ?>


<?php include "custnav.php" ?>

<div class="container-fluid">
	<div class="profile">
		<div class="profile-box">


			<div class="profile-header">
				<p class="fs-4">Set Up Profile</p>
			</div>
			<?php 

			if (isset($_GET['error'])) {
		switch ($_GET['error']) {
			case 1:
				echo "<p class='text-danger' align='center'>Connection Failed</p>";
				break;
			case 2:
				echo "<p class='text-danger' align='center'>Not Saved</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}
?>

			<div class="profile-body">
				<form action="includes/addprofile.php" method="POST">
				
					<div class="field">
	                    <span class="bi bi-person"></span>
	                    <input type="text" name="fn" required="" placeholder="Full Name">               
	                </div> 
	                <div class="field">
	                    <span class="bi bi-check"></span>
	                    <input type="text" name="age" required="" placeholder="Age">               
	                </div>  
	                <div class="field">
	                    <span class="bi bi-check"></span>
	                    <select class="form-select" name="gender">
	                    	 <option selected>Gender</option>
						  <option value="Male">Male</option>
						  <option value="Female">Female</option> 
						</select>               
	                </div> 
	                <div class="field">
	                    <span class="bi bi-telephone"></span>
	                    <input type="text" name="pn" required="" placeholder="Phone Number">               
	                </div> 
	          
	                <div class="address">
	                	<div class="field">
	                    	<span class="bi bi-geo-alt"></span>
	                    	<input type="text" name="province" required="" placeholder="Province">               
	                	</div>
	                	<div class="field">
	                    	<span class="bi bi-check"></span>
	                    	<input type="text" name="city" required="" placeholder="City">               
	                	</div> 
	                	<div class="field">
	                    	<span class="bi bi-check"></span>
	                    	<input type="text" name="brgy" required="" placeholder="Barangay">               
	                	</div>
	                	<div class="field">
	                    	<span class="bi bi-check"></span>
	                    	<input type="text" name="add_details" required="" placeholder="Address Details">               
	                	</div>

	                </div> 
	                <button type="submit" class="save" name="save">Save</button>                      
				</form>
			</div>
		</div>
	</div>
</div>


	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>