<!DOCTYPE html>
<html>
<head>
</head>
<body>
<header>
<div class="container-fluid fixed-top">
	<div class="row" style="background-color: white;">
		
		<div class="col-3" align="left">
			<div class="my-md-3">
				<img src="img/logo1.png" width="130px">
			</div>
		</div>

		<div class="col-6">
			
			<nav class="navbar navbar-expand-lg navbar-light">
				  <div class="container-fluid">
				    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				      <span class="navbar-toggler-icon"></span>
				    </button>
				    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
				      <ul class="navbar-nav mx-auto">
				        <li class="nav-item">
				          <a class="nav-link"  href="index.php"><b><i class="bi bi-shop" style="font-size:26px; font-weight: 600; "></i> Home</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="cart.php"><b><i class="bi bi-cart" style="font-size:26px; font-weight: 600; "></i> Cart</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="myorders.php"><b><i class="bi bi-handbag" style="font-size:26px; font-weight: 600; "></i> My Orders</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="account.php"><b><i class="bi bi-person" style="font-size:26px; font-weight: 600; "></i> Account</a></b>
				        </li>
				      </ul>
				    </div>
				  </div>
			</nav>
			
		</div>
		
<?php 

if (isset($_SESSION['password']) || isset($_SESSION['email'])) {

?>
		<div class="col-3" align="right">
			<div class="my-md-3">
				<a href="login.php"><button class="btn" style="
	background-color: #29a3a3;
	border-radius: 25px;
	width: 130px;
    border: none;
    color: white;
    font-weight: 500;
    padding: 10px 20px;
    text-align: center;
    font-size: 16px;
    margin-right: 20px;
  ">Log Out</button></a>
			</div>
		</div>

<?php
}
else{
?>
	<div class="col-3" align="right">
			<div class="my-md-3">
				<a href="login.php"><button class="btn" 
style="
	background-color: #29a3a3;
	border-radius: 25px;
	width: 130px;
    border: none;
    color: white;
    font-weight: 500;
    padding: 10px 20px;
    text-align: center;
    font-size: 16px;
    margin-right: 20px;
  ">Log In</button></a>
			</div>
		</div>


<?php
}
?>

		
	</div>
		
</div>

</header>
</body>
</html>
