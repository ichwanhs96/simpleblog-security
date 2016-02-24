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
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_SESSION['userId'].$_FILES["Gambar"]["name"]);
	$uploadOk = false;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["Gambar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = true;
    } else {
        $_SESSION['Status'] = "File is not an image.";
	    $utils->redirect("new_post.php");
	    $uploadOk = false;
    }	
	// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = false;
		$_SESSION['Status'] = "Sorry, file already exists.";
	    $utils->redirect("new_post.php");
	}
	// Check file size
	if ($_FILES["Gambar"]["size"] > 2000000) {
		$uploadOk = false;
	    $_SESSION['Status'] = "Sorry, your file is too large.";
	    $utils->redirect("new_post.php");
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$uploadOk = false;
		$_SESSION['Status'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $utils->redirect("new_post.php");
	}
	
	if ($uploadOk) {
		if (move_uploaded_file($_FILES["Gambar"]["tmp_name"], $target_file)) {
			//updating data
			$gambar = $db->quote(basename($_SESSION['userId'].$_FILES["Gambar"]["name"]));
			$query = "UPDATE info_post SET judul=".$judul.", konten=".$konten.", gambar=".$gambar." WHERE ID=".$ID."";
			$result = $db->query($query);
			if($result){
				$_SESSION['Status'] = "Edit post success!";
				$utils->redirect("index.php");
			} else {
				$_SESSION['Status'] = "Edit post failed!";
				$utils->redirect("index.php");
			}
		} else {
	    	$_SESSION['Status'] = "Sorry, there was an error uploading your file.";
	    	$utils->redirect("new_post.php");
	    }
	} else {

	}
}
?>