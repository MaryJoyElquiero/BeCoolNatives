<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
	<title>MYORDERS</title>
</head>
<body>
<?php 

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}

 ?>

<?php include "custnav.php" ?>
<div class="container-fluid">
<div class="orders">
	<div class="row">
		<div class="col-md-7 col-12" align="left">
			<div class="my-md-2">
				<p class="fs-3">My Orders</p>
			</div>
			
		</div>
		<div class="col-md-5 col-12" align="right">
			<div class="my-md-2">
				<div class="input-group">
					<input class="form-control" type="text" name="search" placeholder="Search Orders">
					<button class="btn btn-outline-dark"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</div>
	
	
	</div>


<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link active"  style="background-color:#30f2e8;" aria-current="page" href="myorders.php">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="topay.php"> To Pay </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="toship.php"> To Ship </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="torecieve.php"> To Recieve</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="completed.php"> Completed</a>
  </li>
 
</ul>

</div>
</div>


<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>


