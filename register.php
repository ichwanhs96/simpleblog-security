<?php
function connect_db()
{
  // Create connection
  $con=mysqli_connect("localhost","root","","simple_post");

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  return $con;
}
?>
<?php  //Start the Session
session_start();
if(isset($_COOKIE['simpleblog-token'])){
  $isTokenValid = false;
  $token = $_COOKIE['simpleblog-token'];
  $con = connect_db();
  $sql_statement = "SELECT * FROM user WHERE token='$token'";
  $results = mysqli_query($con, $sql_statement);
  while($result=mysqli_fetch_array($results)){
    $isTokenValid = true;
    $_SESSION['Fingerprint'] = $result['fingerprint'];
    $_SESSION['Username'] = $result['username'];
  }

  $username = $_SESSION['Username'];

  if($isTokenValid){
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes(16));

    $sql = "UPDATE user SET token='$token' WHERE username='$username'";
    
    if (!mysqli_query($con,$sql)) 
    {
      die('Error: ' . mysqli_error($con));
    }   

    $cookie_name="simpleblog-token";
    $cookie_value=$token;
    setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60)); //20 years;
    mysqli_close($con);

    $url = "index.php";
    
    function redirect($url, $statusCode = 303)
    {
       header('Location: ' . $url, true, $statusCode);
       die();
    }
    
    redirect($url);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Simple Blog Register</title>
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
          <h1 class="text-center">Register</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="register_redirect.php"  onsubmit="return validateRegistration()">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Email" id="Username" name="Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" placeholder="Password" id="Password" name="Password">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Register" class="btn btn-primary btn-lg btn-block">
            </div>
          </form>
      </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
    <script type="text/javascript" src="assets/js/ajax.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>