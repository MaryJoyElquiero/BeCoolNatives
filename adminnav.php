<!DOCTYPE html>
<html>
<head>
</head>
<body>
<header>
<div class="container-fluid fixed-top">
	<div class="row" style="background-color: white;">
		
		<div class="col-2" align="left">
			<div class="my-md-3">
				<img src="img/logo1.png" width="130px">
			</div>
		</div>

		<div class="col-8">
			
			<nav class="navbar navbar-expand-lg navbar-light">
				  <div class="container-fluid">
				    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				      <span class="navbar-toggler-icon"></span>
				    </button>
				    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
				      <ul class="navbar-nav mx-auto">
				      	 <li class="nav-item">
				          <a class="nav-link" href="admin_dashboard.php"><b><i class="bi bi-grid" style="font-size:26px; font-weight: 600; "></i> Dashboard</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link"  href="admin_requests.php"><b><i class="bi bi-bookmark-plus" style="font-size:26px; font-weight: 600; "></i> Requests </a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="admin_products.php"><b><i class="bi bi-card-list" style="font-size:26px; font-weight: 600; "></i> Products</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="categories.php"><b><i class="bi bi-tag" style="font-size:26px; font-weight: 600; "></i> Categories</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="admin_customers.php"><b><i class="bi bi-people" style="font-size:26px; font-weight: 600; "></i> Customers</a></b>
				        </li>
				        <li class="nav-item">
				          <a class="nav-link" href="admin_sellers.php"><b><i class="bi bi-shop" style="font-size:26px; font-weight: 600; "></i> Shops/Sellers</a></b>
				        </li>
				      </ul>
				    </div>
				  </div>
			</nav>
			
		</div>
		
		<div class="col-2" align="right">
			<div class="my-md-3">
				<form action="includes/logout.php" method="POST">
				<button name="adminlogout" class="btn" style="
						background-color: #29a3a3;
						border-radius: 25px;
						width: 130px;
					    border: none;
					    color: white;
					    font-weight: 500;
					    padding: 10px 20px;
					    text-align: center;
					    font-size: 16px;
					    margin-right: 10px;
					  
				  ">Log Out</button>
				</form>
				  
							</div>
		</div>

	</div>
		
</div>

</header>
</body>
</html>
