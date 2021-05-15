<?php
session_start();



if (!isset($_SESSION['admin_pass']) || !isset($_SESSION['admin_email'])) {
	header("Location:login.php?error=1");
	exit();
}


 ?>
<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>Categories</title>
</head>
<body>

<?php include_once "includes/conn.php"; ?>


<!--Add item Modal-->
<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      		<form action="includes/addcategory.php" method="POST">
	        			
	        			<div class="mb-1">
  							<label for="cat_desc" class="form-label">Category Name</label>
  							<input type="text" class="form-control" name="cat_desc" id="cat_desc" required="">
						</div>
						<div class="mb-1">
  							<label class="form-label" for="cat_status">Status</label>
								  <select class="form-select" name="cat_status" id="cat_status" required="">
								  	<option value="Active" selected> Active</option>
									<option value="Inactive">Inactive</option>
									    
									    ?>
								  </select>	  							
						</div>	
					
	        		</div>

    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success" name="save"><i class="bi bi-save"></i> Add</button>
      </div>
      </form>
    </div>
  </div>
</div> 


<?php include "adminnav.php"; ?>


<div class="container-fluid" id="content">

			<div class="card mt-3">
				<div class="card-header" style="background-color:white;">
					<div class="row mt-2">

						<div class="col-4">
				  				<?php  
				  					$sql="SELECT count('1') FROM category;";
									$result=mysqli_query($conn,$sql);
									$row=mysqli_fetch_array($result);
									echo "<p class='fs-5'>Total:". $row[0]. "</p>";
									
				  				?>
				  		</div>				    

			    		<div class="col-4">
								<form method="GET">
									<div class="input-group">
										<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Category">
										<button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
									</div>
								</form>
						</div>
						<div class="col-4" align="right">
				  			<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addItem"><i class="bi bi-plus-square"></i> Add Category</button>
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
				echo "<p class='text-danger' align='center'>Category Already Exists</p>";
				break;
			case 3:
				echo "<p class='text-success' align='center'> Added Successfully</p>";
				break;
			case 4:
				echo "<p class='text-danger' align='center'> Failed to Add</p>";
				break;
			case 5:
				echo "<p class='text-success' align='center'> Saved</p>";
				break;
			case 6:
				echo "<p class='text-success' align='center'> Not Saved</p>";
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
    		$sql= "SELECT * FROM category;";

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
				echo "<th>Categories</th>";
				echo "<th>Status</th>";
				echo "<th>Actions</th>";
				echo "</thead>";
				echo "<br>";


 				if (!empty($arr)) {
			    foreach ($arr as $key => $value) {
			 
				echo "<tr>";
				echo "<td>". $value['cat_desc'] ."</td>";
				echo "<td>". $value['cat_status'] ."</td>";
				
				echo "<td> 
						<a href='edit_category.php?id=".$value['cat_id']."'>
						<button type='button' class='btn btn-outline-success' name='edit'> Edit </button>
						</a></td>";
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