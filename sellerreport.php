<?php
session_start();



if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:login.php?error=1");
	exit();
}


 ?>
<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    
    <title>Products</title>
</head>
<body>

<?php include_once "includes/conn.php"; ?>





<?php include "sellernav.php"; ?>


<div class="container-fluid" id="content">

			<div class="card mt-3">
				<div class="card-header" style="background-color:white;">
					<div class="row mt-2">

							    

			    		<div class="col-4">
								<form method="GET">
									<div class="input-group">
										<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search item name">
										<button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
									</div>
								</form>
						</div>
						
					</div>
				</div>

			 
			  <div class="card-body">

			  	<div align="center">
	<?php 
	if (isset($_GET['error'])) {
		switch ($_GET['error']) {
			case 1:
				echo "<p class='text-danger' align='center'>Connection Failed</p>";
				
		}
	}




	 ?>
</div>
	 <ul class="nav nav-pills nav-fill">

    <li class="nav-item">
  	<a class="nav-link active"  style="background-color:#29a3a3;" aria-current="page" href=" sellerreport.php"> Seller Report</a>
    
  </li>
    <li class="nav-item">
  <a class="nav-link "  style="background-color:white;color:black;" href=" adminReport 1.php"> Registered Accounts</a>
    
    
  </li>
  <li class="nav-item">
 <a class="nav-link "  style="background-color:white;color:black;" href=" adminReport 2.php">Shop Total Sales</a>
    
    
  </li>
   
   
</ul>
    <div class="container-fluid">
    	<div class="row">
    	<div class="col">

    		<?php 
    		$sql= "SELECT  i.item_name
                     , i.item_short_code 
                     , SUM(o.order_total) as order_total
                     ,SUM(o.order_qty) as order_qty 
    		              from orders o
    		              JOIN items i 
    		              on i.item_id = o.item_id
    		              GROUP by i.item_id";
   
   
				$stmt=mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					echo "Connection Failed";
					exit();
				}

				mysqli_stmt_execute($stmt);
			    $items= mysqli_stmt_get_result($stmt);
			    $arr= array();
			    while ($row= mysqli_fetch_assoc($items)){
			    	array_push($arr, $row);
			    }
			   
			    echo "<table class='table' id= 'myTable'>";
				echo "<thead class='table-light'>";
				echo "<th>Item Name</th>";
				echo "<th>Item Short Code</th>";
				echo "<th>Total Orders</th>";
				echo "<th>Total Sales</th>";
				echo "</thead>";
				echo "<br>";


 				if (!empty($arr)) {
			    foreach ($arr as $key => $value) {
			 
				echo "<tr>";
				echo "<td>". $value['item_name'] ."</td>";
				echo "<td>". $value['item_short_code'] ."</td>";
				echo "<td>". $value['order_qty'] ."</td>";
				echo "<td>Php ". $value['order_total'] ."</td>";
				echo "</tr>";
			    }
			    echo "<tr>";
				echo "<td colspan =100 class='text-center'><em> End of Result  </em></td>";
				echo "</tr>";
			}
			 else {
			    echo "<tr>";
			    echo "<td colspan =100 class='text-center'><em> No records Found  </em></td>";
			    echo "</tr>";
			    }
			    echo "</table>";
			

			   

    		 ?>
    		
    	</div>


   
    	</div>
    </div>

			  	
			  </div>
			</div>
		
	</div>




<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>




<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>




</body>
</html>