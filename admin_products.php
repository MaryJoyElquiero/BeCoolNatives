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
    <title>Products</title>
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
				  					$sql="SELECT count('1') FROM items;";
									$result=mysqli_query($conn,$sql);
									$row=mysqli_fetch_array($result);
									echo "<p class='fs-5'>Total:". $row[0]. "</p>";
									
				  				?>
				  		</div>				    

			    		<div class="col-6">
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
    		$sql= "SELECT i.item_id, i.item_name,i.item_short_code, p.price_amt, ct.cat_desc, i.item_stat, sh.shop_name, ac.acc_cn
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id
									JOIN shop sh
									ON i.shop_id=sh.shop_id
									JOIN accinfo ac
									ON ac.acc_id=sh.acc_id;";

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
				echo "<th>Item Price</th>";
				echo "<th>Item Category</th>";
				echo "<th>Item Status</th>";
				echo "<th>Shop Name</th>";
				echo "<th>Seller Name</th>";
				echo "<th>Delete</th>";
				echo "</thead>";
				echo "<br>";


 				if (!empty($arr)) {
			    foreach ($arr as $key => $value) {
			 
				echo "<tr>";
				echo "<td>". $value['item_name'] ."</td>";
				echo "<td>". $value['item_short_code'] ."</td>";
				echo "<td>Php ". number_format($value['price_amt'],2) ."</td>";
				echo "<td>". $value['cat_desc'] ."</td>";
				echo "<td>". $value['item_stat'] ."</td>";
				echo "<td>". $value['shop_name'] ."</td>";
				echo "<td>". $value['acc_cn'] ."</td>";
				
				  echo "<form action='includes/deleteItem.php' method='POST'>";
				  echo "<input type='hidden' name='item_id' value='". $value['item_id']."'>";
				echo "<td><button type='submit' class='btn btn-outline-danger' name='delete3'> Delete </button></td>";
				echo "</form>";
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