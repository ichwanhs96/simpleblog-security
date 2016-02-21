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

function select_db()
{
	$id = $_POST['postIdPost'];
	$con = connect_db();
	$sql_statement = "SELECT * FROM info_post WHERE ID=$id";
	$results = mysqli_query($con, $sql_statement);
	
	return $results;
}

?>

<?php  //Start the Session
session_start();
if (isset($_POST['Username']) and isset($_POST['Password'])){
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$isUserFound = false;
	$con = connect_db();
	$sql_statement = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	 
	$results = mysqli_query($con, $sql_statement);
	while($result=mysqli_fetch_array($results)){
		$isUserFound = true;
	}
	//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
	if ($isUserFound){
		$_SESSION['Username'] = $username;
	}else{
		//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
		$_SESSION['Status'] = "Invalid Login Credentials";
		//3.2 When the user visits the page first time, simple login form will be displayed.
		$url = "login.php";
		
		function redirect($url, $statusCode = 303)
		{
		   header('Location: ' . $url, true, $statusCode);
		   die();
		}
		
		redirect($url);
		}
}else{
	//3.2 When the user visits the page first time, simple login form will be displayed.
	$url = "login.php";
	
	function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
	
	redirect($url);
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Simple Blog</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
    </ul>
</nav>


<div id="home">
    <div class="posts">
        <nav class="art-list">
          <ul class="art-list-body">
		  <?php
				$con = connect_db();
				$sql_statement = "SELECT * FROM info_post ORDER BY tanggal DESC";
				$results = mysqli_query($con, $sql_statement);
				echo "
					<form method='post' action='edit_post.php' id='hiddenFormEdit'>
						<input type='hidden' name='postIdEdit' id='postIdEdit'>
					</form>
					<form method='post' action='post.php' id='hiddenFormPost'>
						<input type='hidden' name='postIdPost' id='postIdPost'>
					</form>
				";
				while($result=mysqli_fetch_array($results))
				{
					echo "
					<li class='art-list-item'>
						<div class='art-list-item-title-and-time'>
							<h2 class='art-list-title'><a href='#' onclick='formSubmitPost(".$result['ID'].")'>".$result['judul']."</a></h2>
							<div class='art-list-time'>".htmlspecialchars($result['tanggal'])."</div>
							<div class='art-list-time'><span style='color:#F40034;'>&#10029;</span> Featured</div>
						</div>
						<p>".htmlspecialchars($result['konten'])."</p>
						<p>
						  <a href='#' onclick='formSubmitEdit(".$result['ID'].")'>Edit</a> | <a href='#' onclick='ConfirmDelete(".$result['ID'].")'>Hapus</a>
						</p>
					</li>";
				}
				mysqli_close($con);
			?>
          </ul>
        </nav>
    </div>
</div>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>
<script type="text/javascript" src="assets/js/index.js"></script>

</body>
</html>