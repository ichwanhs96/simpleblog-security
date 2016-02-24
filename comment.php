<?php
include('auth.php');
require_once('class/userManagement.php');

$db = new Db();
$userManagement = new userManagement();

$id = $_GET['ID'];
$komentar = $_GET['Komentar'];
$token = $_GET['token'];

$id = $db->quote($id);
$komentar = $db->quote($komentar);

if($token != $_SESSION['token']  || !$userManagement->isUserExist($_SESSION['userId'])){
	$_SESSION['Status'] = "Invalid Login Credentials";
	$utils->redirect("login.php");
} else {
	//insert new data
	$query = "INSERT INTO info_komentar (ID, komentar, user_id)
			VALUES (".$id.", ".$komentar.", ".$_SESSION['userId'].")";

	$result = $db->query($query);
	if(!$result){
		$_SESSION['Status'] = "add comment failed!";
		$utils->redirect("post.php?id="+$id);
	}

	$query = "SELECT * FROM info_komentar WHERE ID=".$id."";
	$results = $db->select($query);
	foreach ($results as $result) {
		$user = $userManagement->getUserById($result['user_id']);
		echo "
		<li class='art-list-item'>
			<div class='art-list-item-title-and-time'>
				<h2 class='art-list-title'><a href='#'>".htmlspecialchars($user['username'])."</a></h2>
				<div class='art-list-time'>2 menit yang lalu</div>
			</div>
			<p style='float:right'>".htmlspecialchars($result['komentar'])."</p>
		</li>
		";
	}
	
}
?>