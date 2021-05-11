<!DOCTYPE html>
<html>
<head>
	<title>LOG IN</title>
	 <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
	<?php  include "custnav.php" ?>
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


               <div class="intro-boxintro">
                    <div class="intro">
                        <h3 class="welcome">Welcome to</h3>
                        <div class="name">
                          <h1 class="be">Be</h1><h1 class="cool">Cool</h1>
                        </div>
                        <h4>Bicol Native Products</h4>
                        <h4>Shop and BE COOL!</h4>
                       
                    </div>
                </div>
                

                <div class="content-box">
                   <div class="content">
                      <div class="text">
                       <h1> <i class="bi bi-person-circle"></i></h1>
                      </div>

                      <form action="includes/login_connect.php" method="POST">
                            <div class="field">
                              <span class="bi bi-envelope"></span>
                              <input type="email" name="email" required="" placeholder="Email">
                              
                            </div>
                            <div class="field">
                              <span class="bi bi-lock"></span>
                              <input type="password" name="password" required="" placeholder="Password">
                            </div>
                            <div class="forgot-pass"><a href="#" >Forgot Password?</a> </div>
                            <button type="submit" class="lgnbtn" name="submit">Log In</button>
                            <div class="createaccount"><a href="signup.php" >Create Account</a> </div>
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
