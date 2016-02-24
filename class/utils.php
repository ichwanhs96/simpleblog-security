<?php
class utils{
	public function redirect($url){
		header('Location: ' . $url, true, 303);
		die();
	}
}
?>