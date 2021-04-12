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

<div class="login">

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

                      <form action="login_connect.php" method="POST">
                              <div class="field">
                              <span class="bi bi-envelope"></span>
                              <input type="text" name="email" required="" placeholder="Email">
                              
                            </div>
                            <div class="field">
                              <span class="bi bi-lock"></span>
                              <input type="password" name="password" required="" placeholder="Password">
                            </div>
                             <div class="field">
                              <span class="bi bi-lock"></span>
                              <input type="password" name="password" required="" placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="lgnbtn" name="submit">Sign Up</button>
                            <div class="createaccount"><a href="login.php" >Log In</a> </div>
                      </form>
                   </div>

                </div>


                 
                

        </div>

    </div>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
