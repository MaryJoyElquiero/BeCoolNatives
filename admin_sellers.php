<?php
session_start();


if (!isset($_SESSION['admin_pass']) || !isset($_SESSION['admin_email'])) {
	header("Location:admin_login.php?error=1");
	exit();
}

 ?>
<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>SHOP/SELLERS</title>
</head>
<body>

<?php include_once "includes/conn.php"; ?>



<?php include "adminnav.php"; ?>


<div class="container-fluid" id="content">

			<div class="card mt-3">
				<div class="card-header" style="background-color:white;">
					<div class="row mt-2">

						<div class="col-6">
				  				<?php  
				  					$sql="SELECT count('1') FROM shop;";
									$result=mysqli_query($conn,$sql);
									$row=mysqli_fetch_array($result);
									echo "<p class='fs-5'>Total:". $row[0]. "</p>";
									
				  				?>
				  		</div>				    

			    		<div class="col-6">
								<form method="GET">
									<div class="input-group">
										<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Shop">
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
				break;
			case 2:
				echo "<p class='text-danger' align='center'>Item Aready Exists</p>";
				break;
			case 5:
				echo "<p class='text-danger' align='center'> Failed to delete</p>";
				break;
			case 6:
				echo "<p class='text-success' align='center'> Item deleted</p>";
				break;
			case 7:
				echo "<p class='text-success' align='center'>Saved</p>";
				break;
			case 8:
				echo "<p class='text-danger' align='center'>Not Saved</p>";
				break;
			default:
				echo "";
				break;
		}
	}




	 ?>

	 </div>
    <div class="container-fluid">
    	<div class="row">
    	<div class="col">

    		<?php 
    		$sql= "SELECT sh.shop_id, sh.shop_name,ac.acc_cn from shop sh
    			JOIN accinfo ac
    			ON sh.acc_id=ac.acc_id
    			GROUP BY sh.shop_id;";

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
				echo "<th>Seller Name</th>";
				echo "<th>Shop Name</th>";
				echo "<th>Items Count</th>";
				echo "<th>Total Orders</th>";
				echo "<th>Total Sales</th>";
				echo "</thead>";
				echo "<br>";


 				if (!empty($arr)) {
			    foreach ($arr as $key => $value) {
			 
				echo "<tr>";
				echo "<td>". $value['acc_cn'] ."</td>";
				echo "<td>". $value['shop_name'] ."</td>";

					$sql= "SELECT count(*)  from items
					WHERE shop_id = '{$value['shop_id']}';";


					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);
					echo "<td>". $row[0]."</td>";

					$sql= "SELECT COALESCE(SUM(o.order_qty),0), COALESCE(SUM(o.order_total),0) from orders o
					JOIN items i
					on i.item_id= o.item_id
					JOIN shop sh
					ON sh.shop_id=i.shop_id
					WHERE sh.shop_id = '{$value['shop_id']}'
					AND order_status !='Cancelled';";

					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);
					echo "<td>". $row[0]."</td>";
					echo "<td>Php ". number_format($row[1],2)."</td>";


				
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
