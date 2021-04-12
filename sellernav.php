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
					<input class="form-control" type="text" name="search" placeholder="Search Becool">
					<button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-12" align="center">
			<div class="my-md-3">
				<button class="btn btn-outline-dark"><i class="bi bi-person-circle"></i><?php echo $_SESSION['email'];?></button>
			</div>
		</div>
	</div>
	<div class="row" style="background-color: white;">
			<nav class="navbar navbar-expand-lg navbar-light">
			  <div class="container-fluid">
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
			      <ul class="navbar-nav mx-auto">
			        <li class="nav-item">
			          <a class="nav-link"  href="shop.php"><b><i class="bi bi-shop"></i>Shop</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="products.php"><b><i class="bi bi-tags"></i> Products</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#"><b><i class="bi bi-clipboard-plus"></i>Orders</a></b>
			        </li>
			        <li class="nav-item">
			          <a class="nav-link" href="#"><b><i class="bi bi-receipt"></i> Report</a></b>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>
	</div>
</div>

</header>
</body>
</html>