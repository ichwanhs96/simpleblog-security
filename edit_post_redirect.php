<?php
include('auth.php');
require_once('class/userManagement.php');

$db = new Db();
$utils = new utils();
$userManagement = new userManagement();

$ID = $_POST['ID'];
$judul = $_POST['Judul'];
$konten = $_POST['Konten'];
$token = $_POST['token'];
$ID = $db->quote($ID);
$judul = $db->quote($judul);
$konten = $db->quote($konten);

if($token != $_SESSION['token'] || !$userManagement->isUserExist($_SESSION['userId'])){
	$_SESSION['Status'] = "Invalid Login Credentials";
	$utils->redirect("login.php");
} else {
	//updating data
	$query = "UPDATE info_post SET judul=".$judul.", konten=".$konten." WHERE ID=".$ID."";
	$result = $db->query($query);
	if($result){
		$_SESSION['Status'] = "Edit post success!";
		$utils->redirect("index.php");
	} else {
		$_SESSION['Status'] = "Edit post failed!";
		$utils->redirect("index.php");
	}
}
?>