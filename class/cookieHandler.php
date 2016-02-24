<?php 
require_once('class/db.php');
require_once('class/tokenHandler.php');

class cookieHandler{
	private $userId;
	private $username;

	//return true if cookie exist
	public function checkCookie(){
		if(isset($_COOKIE['simpleblog-token'])){
			//get token
			$token = $_COOKIE['simpleblog-token'];
  			$db = new Db();
  			$token = $db->quote($token);
  			$query = "SELECT * FROM user WHERE token=".$token."";
  			$results = $db->select($query);
  			foreach ($results as $result) {
  				$userId = $result['ID'];
  				$username = $result['username'];
  			}
			return true;
		} else return false;
	}

	public function generateNewCookie($string){
		if($userId == null) return false;
		$token = new tokenHandler().generateTokenWithSpecificString($string);
    	$cookie_name = "simpleblog-token";
		$cookie_value = $token;
		setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60)); //20 years;
		$db = new Db();
		$token = $db->quote($token);
		$query = "UPDATE user SET token=".$token." WHERE ID = ".$userId."";
		$results = $db->query($query);
		if($results){
			return true;
		} else return false;
	}

	public function updateCookie($token){
		if($userId == null) return false;
		$cookie_name = "simpleblog-token";
		$cookie_value = $token;
		setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60)); //20 years;
		$db = new Db();
		$token = $db->quote($token);
		$query = "UPDATE user SET token=".$token." WHERE ID = ".$userId."";
		$results = $db->query($query);
		if($results){
			return true;
		} else return false;
	}

	public function deleteCookie(){
		if($userId == null) return false;
		setcookie("simpleblog-token", "", time() - 3600);
		$token = new tokenHandler().generateRandomToken();
		$db = new Db();
		$token = $db->quote($token);
		$query = "UPDATE user SET token=".$token." WHERE ID =".$userId."";
		$results = $db->query($query);
		if($results){
			return true;
		} else return false;
	}

	public function getUserId(){
		return $userId;
	}

	public function getUsername(){
		return $username;
	}

	public function setUserId($id){
		$userId = $id;
	}

	public function setUsername($user){
		$username = $user;
	}
}
?>