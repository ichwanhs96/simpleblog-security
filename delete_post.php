<?php
	require_once('class/db.php');
	require_once('class/utils.php');
	require_once('class/tokenHandler.php');
	require_once('class/userManagement.php');

	include('auth.php');
	$token = $_GET['token'];
	$sessionToken = $_SESSION['token'];
	$tokenHandler = new tokenHandler();
	$utils = new utils();
	//check is token valid or not
	if($token!= $sessionToken){
		$utils()->redirect("login.php");
	}
	//if token valid generate new random unguessable token for user
	$_SESSION['token'] = $tokenHandler->regenerateToken(session_id(),"delete_post");

	//get user id
	$userId = $_SESSION['userId'];
	//connect db
	$db = new Db();
	
	$ID = $_GET['ID'];
	$ID = $db -> quote($ID);

	$query = "DELETE FROM info_post WHERE ID=".$ID." AND user_id = ".$userId."";
	$result = $db -> query($query);
	if($result){
		echo "success";
	} else {
		echo "user not valid";
	}
?>