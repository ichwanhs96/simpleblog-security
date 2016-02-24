<?php
require_once('class/db.php');
require_once('class/cookieHandler.php');
require_once('class/tokenHandler.php');
require_once('class/utils.php');
require_once('class/userManagement.php');

session_start();
$cookieHandler = new cookieHandler();
$utils = new utils();
$tokenHandler = new tokenHandler();
if (isset($_POST['Username']) and isset($_POST['Password'])){
	$isUserValid = false;
	$username = $_POST['Username'];
	$password = $_POST['Password'];

	$db = new Db();
	$username = $db->quote($username);

	$query = "SELECT * FROM user WHERE username=".$username."";

	$results = $db->select($query);
	foreach ($results as $result) {
		if($password == $result['password']){
			$isUserValid = true;
			$_SESSION['userId'] = $result['ID'];
			$_SESSION['username'] = $result['username'];
		}
	}

	if ($isUserValid){
		//if user can login
		session_regenerate_id();
		if(isset($_POST['RememberMe'])){
			//make a new cookie
			$string = "".session_id()."RememberMe"."KPI".time();
			$cookieHandler = new cookieHandler();
			$cookieHandler->setUserId($_SESSION['userId']);
			$cookieHandler->setUsername($_SESSION['username']);
			$cookieHandler->generateNewCookie();
		}
		$string = "".session_id()."Login"."KPI".time();
		$_SESSION['token'] = $tokenHandler->generateTokenWithSpecificString($string);
	}else{
		//If the login credentials doesn't match, he will be shown with an error message.
		$_SESSION['Status'] = "Invalid Login Credentials";
		//When the user visits the page first time, simple login form will be displayed.
		$utils->redirect("login.php");
	}
}
else if($cookieHandler->checkCookie()){
  $_SESSION['userId'] = $cookieHandler->getUserId();
  $_SESSION['username'] = $cookieHandler->getUsername();
  $string = "".session_id()."RememberMe"."KPI".time();
  $token = new tokenHandler().generateTokenWithSpecificString($string);
  $_SESSION['token'] = $token;
  $cookieHandler->updateCookie($token);
  $utils->redirect("index.php");
}
else if(isset($_SESSION['userId']) && isset($_SESSION['username']) && isset($_SESSION['token'])){
	$userManagement = new userManagement();
	if($userManagement->isUserExist($_SESSION['userId'])){
		
	} else {
		$utils = new utils();
		$_SESSION['Status'] = "Invalid Login Credentials";
		$utils->redirect("login.php");
	}
}
else{
	$utils->redirect("login.php");
}
?>