<?php  //Start the Session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Simple Blog Login</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="assets/css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
          <?php 
          if (isset($_SESSION['Status'])){
            echo "<p>".$_SESSION['Status']."</p>";
            unset($_SESSION['Status']);
          }
          ?>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="index.php">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Email" id="Username" name="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" id="Password" name="Password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Sign In</button>
              <span class="pull-right"><a href="register.php">Register</a></span><span><a href="#">Need help?</a></span>
            </div>
          </form>
      </div>
      <div class="modal-footer">
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>