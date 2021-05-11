<?php 
session_start();

if (!isset($_SESSION['password']) || !isset($_SESSION['email'])) {
	header("Location:../login.php?error=1");
	exit();
}


if (isset($_POST['addtocartbtn'])) {
	include_once "conn.php";	
	$item_id=htmlentities($_POST['item_id']);
	$price_id=htmlentities($_POST['price_id']);
	$item_qty=htmlentities($_POST['item_qty']);
	$price_amt=htmlentities($_POST['price_amt']);
	$total_amt=$item_qty* $price_amt;

	$sql="SELECT acc_id FROM accounts WHERE email='{$_SESSION['email']}' 
	and password='{$_SESSION['password']}';";
	$result = mysqli_query($conn, $sql); 
	if (mysqli_num_rows($result)) { 
	    while ($row = mysqli_fetch_assoc($result)) { 
	        $acc_id=$row['acc_id'];
	    }
	 
	 } 
	 else{
	 	header("Location: index.php?error=1");
		exit();
	}

	$sql1="INSERT INTO cart(item_id, acc_id, price_id,item_qty, total_amt) VALUES (?,?,?,?,?);";
	$stmt1= mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt1,$sql1)) {
		header("Location: index.php?error=1");
		exit();
	}
	mysqli_stmt_bind_param($stmt1, "sssss", $item_id, $acc_id, $price_id, $item_qty, $total_amt);
	mysqli_stmt_execute($stmt1);

	header("Location:../index.php?error=2");
	exit();
}	


if (isset($_POST['buynow'])) {
	$item_id=htmlentities($_POST['item_id']);
	$item_qty=htmlentities($_POST['item_qty']);
	$price_amt=htmlentities($_POST['price_amt']);
	$total_amt= $item_qty * $price_amt;


	header("Location: ../orderform2.php?item_id=$item_id&&item_qty=$item_qty&&total_amt=$total_amt&&price_amt=$price_amt");
	exit();
	
}



 ?>
