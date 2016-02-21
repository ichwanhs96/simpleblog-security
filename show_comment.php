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