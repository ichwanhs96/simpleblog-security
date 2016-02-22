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
	
	date_default_timezone_set("Asia/Jakarta");
	
	function makeWaktu()
	{
		if (date("a")=="pm")
		{
			$jam = date("h") + 12;
			$waktu = date("$jam:i:s");
			return $waktu;
		}
		else
		{
			return date("h:i:s");
		}
	}
	
	$id = mysqli_real_escape_string($con, $_GET['ID']);
	$nama = mysqli_real_escape_string($con, $_GET['Nama']);
	$tanggal = date("Y-m-d");
	$waktu = makeWaktu();
	$komentar = mysqli_real_escape_string($con, $_GET['Komentar']);
	
	//insert new data
	$sql = "INSERT INTO info_komentar (ID, nama, komentar, tanggal, waktu)
			VALUES ('$id', '$nama', '$komentar', '$tanggal', '$waktu')";
	
	if (!mysqli_query($con,$sql)) 
	{
		die('Error: ' . mysqli_error($con));
	}
	
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