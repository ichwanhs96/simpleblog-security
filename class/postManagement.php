<?php 
require_once('class/db.php');
require_once('class/utils.php');
require_once('class/userManagement.php');

class postManagement{
	public function getPostById($postId){
		$db = new Db();
		$query = "SELECT * FROM info_post WHERE ID=".$db->quote($postId)."";
		$results = $db->select($query);
		if($results != null){
			foreach ($results as $result) {
				return $result;
			}
		} else {
			$utils = new utils();
			$utils->redirect("index.php");
		}
	}
}
?>