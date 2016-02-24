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
		        //insert new data
		        $gambar = $db->quote(basename($_SESSION['userId'].$_FILES["Gambar"]["name"]));
				$query = "INSERT INTO info_post (judul, konten, user_id, gambar) VALUES (".$judul.", ".$konten.", ".$userId.", ".$gambar.")";
				$result = $db->query($query);
				if($result){
					$_SESSION['Status'] = "Post added!";
					$utils->redirect("index.php");
				} else {
					$_SESSION['Status'] = "Error, cannot add post!";
					$utils->redirect("new_post.php");
				}
		    } else {
		    	$_SESSION['Status'] = "Sorry, there was an error uploading your file.";
		    	$utils->redirect("new_post.php");
		    }
		} else {
			$_SESSION['Status'] = "Sorry, there was an error.";
	    	$utils->redirect("new_post.php");
		}
	} else {
		$_SESSION['Status'] = "Invalid Login Credentials";
		$utils->redirect("login.php");
	}
}
?>