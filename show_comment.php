<?php
include('auth.php');
require_once('class/userManagement.php');
$db = new Db();	
$id = $_GET['ID'];
$id = $db->quote($id);
$query = "SELECT * FROM info_komentar WHERE ID=".$id."";
$results = $db->select($query);
$userManagement = new userManagement();
foreach ($results as $result) {
	$user = $userManagement->getUserById($result['user_id']);
	echo "
		<li class='art-list-item'>
			<div class='art-list-item-title-and-time'>
				<h2 class='art-list-title'><a href='#'>".htmlspecialchars($user['username'])."</a></h2>
				<div class='art-list-time'>2 menit yang lalu</div>
			</div>
			<p>".htmlspecialchars($result['komentar'])."</p>
		</li>
	";
}
?>