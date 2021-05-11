<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT SHOP NAME</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/editshop.css">
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
<div class="shop">
	<form action="includes/editshop.php" method="POST">

			<div class="row">
			<div class="header">
				<div class="info"> 
					<div class="text">
						EDIT SHOP NAME
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="shop-info">
				<div class="icon"><i class="bi bi-shop"></i></div>
				<div class="info"> 
					<div class="label">Shop Name:</div>
					<div class="text">
						<?php 
						include_once "includes/conn.php";
						$sql="SELECT sh.shop_name, sh.shop_id
								FROM shop sh
								JOIN accounts a
								ON sh.acc_id=a.acc_id 
								WHERE a.email='{$_SESSION['email']}'
								AND a.password='{$_SESSION['password']}';";

						$stmt= mysqli_stmt_init($conn);

							if(!mysqli_stmt_prepare($stmt,$sql)) {
								header("Location:editshop.php?error= Connection Failed");
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
							
						<input type="text" name="shop_name" placeholder="Shop Name"  value="<?php echo $val['shop_name'];?>" required autofocus >
						<button type="submit" name="saveedit"> Save </button>
					
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		
</form>
</div>
</div>



<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>