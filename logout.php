<?php
include('auth.php');		
session_destroy();
$db = new Db();
//unset cookie if exist
if(isset($_COOKIE['simpleblog-token'])){
	$string = "".session_id()."Logout"."KPI".time();
	setcookie("simpleblog-token", "", time() - 3600);
	$token = $tokenHandler->generateTokenWithSpecificString($string);
	$token = $db->quote($token);
	$query = "UPDATE user SET token=".$token." WHERE ID=".$_SESSION['userId']."";
	$result = $db->query($query);
}
$utils->redirect("login.php");
?>