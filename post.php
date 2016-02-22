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
if(isset($_SESSION['Fingerprint']) && isset($_SESSION['Username'])){
	$isFingerprintValid = false;
	$con = connect_db();
	$fingerprint = $_SESSION['Fingerprint'];
	$username = $_SESSION['Username'];
	$sql_statement = "SELECT * FROM user WHERE username='$username' and fingerprint='$fingerprint'";
	$results = mysqli_query($con, $sql_statement);
	while($result=mysqli_fetch_array($results)){
		$isFingerprintValid = true;
	}

	if(!$isFingerprintValid){
		$_SESSION['Status'] = "Invalid Login Credentials";
		$url = "login.php";
		
		function redirect($url, $statusCode = 303)
		{
		   header('Location: ' . $url, true, $statusCode);
		   die();
		}
		
		redirect($url);
	}

	$length = 50;
	$fingerprint = bin2hex(openssl_random_pseudo_bytes(16));
	$username = $_SESSION['Username'];
	$sql = "UPDATE user SET fingerprint='$fingerprint' WHERE username='$username'";
	
	if (!mysqli_query($con,$sql)) 
	{
		die('Error: ' . mysqli_error($con));
	}

	$_SESSION['Fingerprint'] = $fingerprint;

	mysqli_close($con);
}
else if(isset($_COOKIE['simpleblog-token'])){
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
		mysqli_close($con);
		
		$cookie_name="simpleblog-token";
		$cookie_value=$token;
		setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60)); //20 years;

		$url = "index.php";
		
		function redirect($url, $statusCode = 303)
		{
		   header('Location: ' . $url, true, $statusCode);
		   die();
		}
		
		redirect($url);
	}
	else {
		mysqli_close($con);
		$_SESSION['Status'] = "Invalid Login Credentials";
		$url = "login.php";
		
		function redirect($url, $statusCode = 303)
		{
		   header('Location: ' . $url, true, $statusCode);
		   die();
		}
		
		redirect($url);
	}
}
else{
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

<?php
	$results = select_db();
	while($result=mysqli_fetch_array($results))
	{
		echo "
		<title>Simple Blog | ".htmlspecialchars($result['judul'])."</title>
		";
	}
?>


</head>

<body class="default" onload="showComment(<?php echo $_POST['postIdPost'] ?>)">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
        <li><?php echo $_SESSION['Username']; ?></a></li>
        <li><a href="logout.php"> logout</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
		<?php
			$results = select_db();
			while($result=mysqli_fetch_array($results))
			{
				echo"
				<div class='art-header-inner' style='margin-top: 500px; opacity: 1;'>
					<time class='art-time'>".htmlspecialchars($result['tanggal'])."</time>
					<h2 class='art-title'>".htmlspecialchars($result['judul'])."</h2>
					<p class='art-subtitle'></p>
				</div>
				";
			}
		?>
    </header>

    <div class="art-body">
        <div class="art-body-inner">
            <hr class="featured-article" />
			<?php
				$results = select_db();
				while($result=mysqli_fetch_array($results))
				{
					echo "
					<p>".htmlspecialchars($result['konten'])."</p>
					";
				}
			?>
            <hr />
            
            <h2>Komentar</h2>

            <div id="contact-area">
                <form method="post" id="comment_form" onsubmit="return false;">
                    <label for="Nama">Nama:</label>
                    <input type="text" name="Nama" id="Nama">
        
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email">
                    
                    <label for="Komentar">Komentar:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>

                    <input type="submit" name="submit" value="Kirim" class="submit-button" onclick="Comment(<?php echo $_POST['postIdPost'] ?>)">
                </form>
            </div>

            <ul class="art-list-body" id="ajaxComment">
            </ul>
        </div>
    </div>

</article>

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
<script type="text/javascript" src="assets/js/ajax.js"></script>

</body>
</html>