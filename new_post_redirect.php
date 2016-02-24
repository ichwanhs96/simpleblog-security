<?php
require_once('class/userManagement.php');
include('auth.php');
$db = new Db();
$judul = $_POST['Judul'];
$konten = $_POST['Konten'];
$token = $_POST['token'];
$judul = $db->quote($judul);
$konten = $db->quote($konten);

$userId = $_SESSION['userId'];
$userManagement = new userManagement();
if($token != $_SESSION['token']){
	$_SESSION['Status'] = "Invalid Login Credentials";
	$utils->redirect("login.php");
} else {
	if($userManagement->isUserExist($userId)){
		//insert new data
		$query = "INSERT INTO info_post (judul, konten, user_id) VALUES (".$judul.", ".$konten.", ".$userId.")";
		$result = $db->query($query);
		if($result){
			$_SESSION['Status'] = "Post added!";
			$utils->redirect("index.php");
		} else {
			$_SESSION['Status'] = "Error, cannot add post!";
			$utils->redirect("new_post.php");
		}
	} else {
		$_SESSION['Status'] = "Invalid Login Credentials";
		$utils->redirect("login.php");
	}
}
?>