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

<?php
session_start();
if(isset($_SESSION['Fingerprint']) && isset($_SESSION['Username'])){
	$length = 50;
	$fingerprint = bin2hex(openssl_random_pseudo_bytes(16));
	$username = $_SESSION['username'];
	$con = connect_db();
	$sql = "UPDATE user SET fingerprint='$fingerprint' WHERE username='$username'";
	
	if (!mysqli_query($con,$sql)) 
	{
		die('Error: ' . mysqli_error($con));
	}

	unset($_SESSION['Fingerprint']);
	unset($_SESSION['Username']);
	session_destroy();

	//unset cookie if exist
	if(isset($_COOKIE['simpleblog-token'])){
		$_SESSION['Debug'] = "simpleblog-token exist";
		setcookie("simpleblog-token", "", time() - 3600);
		$length = 50;
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$sql = "UPDATE user SET token='$token' WHERE username='$username'";
		if (!mysqli_query($con,$sql)) 
		{
			die('Error: ' . mysqli_error($con));
		}
	}

	mysqli_close($con);

	$url = "login.php";
		
	function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
	
	redirect($url);
}
else{
	session_destroy();
	$con = connect_db();
	//unset cookie if exist
	if(isset($_COOKIE['simpleblog-token'])){
		setcookie("simpleblog-token", "", time() - 3600);
		$length = 50;
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		$sql = "UPDATE user SET token='$token' WHERE username='$username'";
		if (!mysqli_query($con,$sql)) 
		{
			die('Error: ' . mysqli_error($con));
		}
	}

	$url = "login.php";
		
	function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
	
	redirect($url);
}
?>