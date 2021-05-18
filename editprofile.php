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
	<form action="includes/updateprofile.php" method="POST">

	<?php 
	include_once "includes/conn.php";



	$sql="SELECT ac.acc_id, ac.acc_cn, ac.acc_age, ac.acc_gender, ac.acc_contact, ac.province, ac.city, ac.brgy, ac.add_details 
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
				<div class="icon"><i class="bi bi-person"></i></div>
				<div class="info"> 
					<div class="label">Full Name:</div>
					<div class="text">
						<input type="text" name="cn" value="<?php echo $val['acc_cn'];  ?>" placeholder="Full Name" required autofocus>
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

						<input type="text" name="province" value="<?php echo $val['province'];  ?>" placeholder="Province" required>
						
						<input type="text" name="city" value="<?php echo $val['city'];  ?>" placeholder="City" required>
						
						<input type="text" name="brgy" value="<?php echo $val['brgy'];  ?>" placeholder="Baranggay" required>
						
						<input type="text" name="add_details" value="<?php echo $val['add_details'];  ?>" placeholder="Address Details" required>
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
						<input type="tel" name="pn" value="<?php echo $val['acc_contact'];  ?>" placeholder="Phone Number" maxlength="11" pattern="09[0-9]{9}" required>
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
						<input type="number" name="age" value="<?php echo $val['acc_age'];  ?>" placeholder="Age" <input type="number" name="age" value="<?php echo $val['acc_age'];  ?>" placeholder="Age" min="13" pattern="[0-9]" onkeypress="return !(event.charCode == 46)" step="1" required> required>
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
						 <select class="form-select" name="gender" required>
	                      <option selected><?php echo $val['acc_gender'];  ?></option>
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
					<input type="hidden" name="acc_id" value="<?php echo $val['acc_id'];  ?>">
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
