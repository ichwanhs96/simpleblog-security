<?php
require_once('class/db.php');
require_once('class/utils.php');

$username = $_POST['Username'];
$password = $_POST['Password'];
$db = new Db();
$hashedPassword = hash('sha256', $password);
$username = $db->quote($username);
$hashedPassword = $db->quote($hashedPassword);
$query = "INSERT INTO user (username, password) VALUES (".$username.", ".$hashedPassword.")";
$results = $db->query($query);
if($results){
	$_SESSION['Status'] = "Registration Success!";
} else {
	$_SESSION['Status'] = "Registration Failed!";
}

$utils = new utils();
$utils->redirect("login.php");
?>