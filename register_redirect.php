<?php
	// Create connection
	$con=mysqli_connect("localhost","root","","simple_post");

	// Check connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$username = mysqli_real_escape_string($con, $_POST['Username']);
	$password = mysqli_real_escape_string($con, $_POST['Password']);

	$options = [
    'cost' => 11,
	];

	$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		
	//insert new data
	$sql = "INSERT INTO user (username, password)
			VALUES ('$username', '$hashedPassword')";
	
	if (!mysqli_query($con,$sql)) 
	{
		die('Error: ' . mysqli_error($con));
	}
	
	mysqli_close($con);
	
	$url = "login.php";
	
	function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
	
	redirect($url);
?>