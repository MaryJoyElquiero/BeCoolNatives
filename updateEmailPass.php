<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/updateEmailPass.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>Edit Account</title>
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



	$sql="SELECT * from accounts
			WHERE email='{$_SESSION['email']}'
			AND password='{$_SESSION['password']}';";

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
				echo "<p class='text-danger'>connectionFailed</p>";
				break;
			case 2:
				echo "<p class='text-success'> Email Changed</p>";
				break;
			case 3:
				echo "<p class='text-danger'>Not Saved</p>";
				break;
			case 4:
				echo "<p class='text-danger'>Wrong Old Password</p>";
				break;
			case 5:
				echo "<p class='text-danger'> Confirm Password Doesn't Match</p>";
				break;
				case 6:
				echo "<p class='text-success'> Password Changed</p>";
				break;
			
			default:
				echo "";
				break;
		}
	}
?>
	<form action="includes/updateEmailPass.php" method="POST">
		<div class="row">
			<div class="email">
				<div class="icon"><i class="bi bi-envelope"></i></div>
				<div class="info"> 
					<div class="label">Email:</div>
					<div class="text">
						<input type="email" name="email" value="<?php echo $val['email'];  ?>" placeholder="Email" required>
						<input type="hidden" name="acc_id" value="<?php echo $val['acc_id'];  ?>" >
						<button type="submit" name="updateEmail"> Update Email</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form action="includes/updateEmailPass.php" method="POST">
		<div class="row">
			<div class="password">
				<div class="icon"><i class="bi bi-lock"></i></div>
				<div class="info"> 
					<div class="label">Password:</div>
					<div class="pass">

						<input type="password" name="oldpass"  placeholder="Old Password" required>
						
						<input type="password" name="newpass"  placeholder="New Password" required>
						
						<input type="password" name="confirmnewpass"  placeholder="Confirm New Password" required>
						<input type="hidden" name="acc_id" value="<?php echo $val['acc_id'];  ?>" >
						
						<button type="submit" name="updatePass"> Update Password</button>
					</div>
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