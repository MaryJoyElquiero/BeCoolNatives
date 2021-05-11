<!DOCTYPE html>
<html>
<head>
	<title>LOG IN</title>
	 <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/admin_login.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
<div class="container-fluid">
<div class="login">

                    <?php 
  if (isset($_GET['error'])) {
    switch ($_GET['error']) {
      case 1:
        echo "<p class='text-danger' align='center'>You must log in first</p>";
        break;
      case 2:
        echo "<p class='text-danger' align='center'>Wrong Username or Password</p>";
        break;
      case 3:
        echo "<p class='text-danger' align='center'> Connection Failed</p>";
        break;
      case 4:
        echo "<p class='text-success' align='center'> Logged Out</p>";
        break;
      default:
        echo "";
        break;
    }
  }
  ?>
  
	 <div class="intro-details">


                <div class="content-box">
                   <div class="content">

                      <div class="text">
                       <h1> <i class="bi bi-person-circle"></i></h1>
                      </div>

                      <form action="includes/login_connect.php" method="POST">
                            <div class="field">
                              <span class="bi bi-envelope"></span>
                              <input type="text" name="email" required="" placeholder="Email">
                              
                            </div>
                            <div class="field">
                              <span class="bi bi-lock"></span>
                              <input type="password" name="password" required="" placeholder="Password">
                            </div>
                            <button type="submit" class="lgnbtn" name="adminlgn">Log In</button>
                            <br>
                      </form>
                   </div>

                </div>


                 
                

        </div>

    </div>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>