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
<?php
	// Create connection
	$con=mysqli_connect("localhost","root","","simple_post");

	// Check connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$id = $_GET['ID'];
	$sql_statement = "SELECT * FROM info_komentar WHERE ID=$id";
	$results = mysqli_query($con, $sql_statement);
	
	while($result=mysqli_fetch_array($results))
	{
		echo "
		<li class='art-list-item'>
			<div class='art-list-item-title-and-time'>
				<h2 class='art-list-title'><a href='#'>".htmlspecialchars($result['nama'])."</a></h2>
				<div class='art-list-time'>2 menit yang lalu</div>
			</div>
			<p>".htmlspecialchars($result['komentar'])."</p>
		</li>
		";
	}
	mysqli_close($con);

?>

<script type="text/javascript" src="assets/js/ajax.js"></script>