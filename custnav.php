<!DOCTYPE html>
<html>
<head>
</head>
<body>
<header>
<div class="container-fluid fixed-top">
	<div class="row" style="background-color: white;">
		
		<div class="col-md-2 col-12" align="center">
			<div class="my-md-3">
				<img src="img/logo1.png" width="130px">
			</div>
		</div>
		<div class="col-md-8 col-12" align="center">
			<div class="my-md-3">
				<div class="input-group">
					<input class="form-control" type="text" name="search" placeholder="Search">
					<button class="btn btn-outline-dark"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</div>

<?php 

if (isset($_SESSION['password']) || isset($_SESSION['email'])) {

?>
		<div class="col-md-2 col-12" align="center">
			<div class="my-md-3">
				<a href="account.php"><button class="btn btn-outline-dark"><i class="bi bi-person-circle"></i> 
					<?php echo $_SESSION['email'];?></button></a>
			</div>
		</div>

<?php
}
else{
?>
	<div class="col-md-2 col-12" align="center">
			<div class="my-md-3">
				<a href="login.php"><button class="btn btn-outline-dark"><i class="bi bi-person-circle"></i>Log In</button></a>
			</div>
		</div>

<?php
}
?>

		
	</div>
	<div class="row" style="background-color: white">
		<div class="col-12">
			<nav class="navbar navbar-expand-lg navbar-light">
			  <div class="container-fluid">
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
			      <ul class="navbar-nav mx-auto">
			        <li class="nav-item">
			          <a class="nav-link"  href="index.php"><b><i class="bi bi-shop"></i> Home</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="cart.php"><b><i class="bi bi-cart"></i> Cart</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="myorders.php"><b><i class="bi bi-handbag"></i> My Orders</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#"><b><i class="bi bi-person-badge"></i> Account</a></b>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>
			</div>
	</div>
</div>

</header>
</body>
</html>