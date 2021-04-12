<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>Products</title>
</head>
<body>

<?php include_once "includes/conn.php"; ?>


<!--Add item Modal-->
<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      		<form action="includes/add_item.php" method="POST" enctype="multipart/form-data">
	        			<div class="mb-1">
  							<label for="item_image" class="form-label">Item Image</label>
  							<input type="file" class="form-control" name="item_img" id="item_image" required="">
						</div>
	        			<div class="mb-1">
  							<label for="item_name" class="form-label">Item Name</label>
  							<input type="text" class="form-control" name="item_name" id="item_name" required="">
						</div>
						<div class="mb-1">
  							<label for="item_short_code" class="form-label">Item Short Code</label>
  							<input type="text" class="form-control" name="item_short_code" id="item_short_code"  required="">
						</div>
						<div class="mb-1">
  							<label for="item_price" class="form-label">Item Price</label>
  							<input type="text" class="form-control" name="item_price" id="item_price"  required="">
						</div>
						<div class="mb-1">
  							<label class="form-label" for="item_category">Item Category</label>
								  <select class="form-select" name="item_category" id="item_category" required="">
								  	<option selected>Select</option>
									    <?php 

									    $sql_cat= "SELECT * FROM category WHERE cat_status='A';";
									    $result= mysqli_query($conn,$sql_cat);
									    if (mysqli_num_rows($result)>0) {
									    	while ($row= mysqli_fetch_assoc($result)) {
									    		echo "<option value='". $row['cat_id']."'>".$row['cat_desc']."</option>";
									    	}
									    }

									    
									    ?>
								  </select>	  							
						</div>	
					
	        		</div>

    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success" name="save"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div> 


<!--Delete Modal-->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<form action="includes/deleteItem.php" method="POST">
      		<input type="hidden" name="delete_id">
      		<h3>Delete Item?</h3>
      </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-outline-danger" name="delete"> Delete</button>
      </div>
  </form>
    </div>
  </div>
</div> 

<?php include "sellernav.php"; ?>


<div class="container-fluid" id="content">

			<div class="card mt-3">
				<div class="card-header">
					<div class="row mt-2">

						<div class="col-4">
				  				<?php  
				  					$sql="select count('1') from items;";
									$result=mysqli_query($conn,$sql);
									$row=mysqli_fetch_array($result);
									echo "<p class='fs-5'>Total:". $row[0]. "</p>";
									
				  				?>
				  		</div>				    

			    		<div class="col-4">
								<form method="GET">
									<div class="input-group">
										<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search item name">
										<button class="btn btn-outline-success"><i class="bi bi-search"></i></button>
									</div>
								</form>
						</div>
						<div class="col-4" align="right">
				  			<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addItem"><i class="bi bi-plus-square"></i> Add Item</button>
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
			case 3:
				echo "<p class='text-success' align='center'> Added Successfully</p>";
				break;
			case 4:
				echo "<p class='text-danger' align='center'> Failed to Add</p>";
				break;
			case 5:
				echo "<p class='text-danger' align='center'> Failed to delete</p>";
				break;
			case 6:
				echo "<p class='text-success' align='center'> Item deleted</p>";
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
    		$sql= "SELECT i.item_id, i.item_name,i.item_short_code, p.price_amt, ct.cat_desc, i.item_stat
									FROM items i
									JOIN category ct
									ON ct.cat_id= i.cat_id
									JOIN price p
									ON i.item_id=p.item_id;";

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
				echo "<th>Edit</th>";
				echo "<th>Delete</th>";
				echo "</thead>";
				echo "<br>";


 				if (!empty($arr)) {
			    foreach ($arr as $key => $value) {
			   
				echo "<tr>";
				echo "<td>". $value['item_name'] ."</td>";
				echo "<td>". $value['item_short_code'] ."</td>";
				echo "<td>P". $value['price_amt'] ."</td>";
				echo "<td>". $value['cat_desc'] ."</td>";
				echo "<td>". $value['item_stat'] ."</td>";
				echo "<td> 	<button type='button' class='btn btn-outline-success'> Edit </button></td>";
				echo "<td>  <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#deletemodal'> Delete </button></td>";
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
	$(document).ready (



		function() {
			$('.btn.btn-outline-danger').on('click', 


				function(){

				$('#deletemodal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();

				}).get();

				console.log(data);
				$('#delete_id').val(data[0]);

			}

			);

	}


	);
</script>


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
