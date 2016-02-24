<?php
class tokenHandler{
	public function generateRandomToken(){
		$bytes = openssl_random_pseudo_bytes(256, $cstrong);
    	$token = bin2hex($bytes);
    	return $token;
	}

	public function generateTokenWithSpecificString($string){
		$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		return password_hash($string, PASSWORD_BCRYPT, $options);
	}

	public function regenerateToken($sessionId, $functionName){
		$string = "".$sessionId.$functionName."KPI".time();
		return $this->generateTokenWithSpecificString($string);
	}
}
?>