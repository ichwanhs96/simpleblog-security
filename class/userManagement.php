<?php 
require_once('class/db.php');
class userManagement{
	public function isUserExist($userId){
		$db = new Db();
		$userId = $db->quote($userId);
		$query = "SELECT * FROM user WHERE ID = ".$userId."";
		$results = $db->select($query);
		if($results != null) return true;
		else return false;
	}

	public function isPostBelongsToUser($userId, $postId){
		$db = new Db();
		$userId = $db->quote($userId);
		$postId = $db->quote($postId);
		$query = "SELECT * FROM info_post WHERE ID = ".$postId." AND user_id=".$userId."";
		$results = $db->select($query);
		if($results != null) return true;
		else return false;
	}

	public function getUserById($userId){
		$db = new Db();
		$userId = $db->quote($userId);
		$query = "SELECT * FROM user WHERE ID = ".$userId."";
		$results = $db->select($query);
		foreach ($results as $result) {
			return $result;
		}
		return false;
	}
}
?>