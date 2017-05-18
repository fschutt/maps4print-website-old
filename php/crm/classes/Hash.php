<?
/**
* Hash class
*/
class Hash
{
	public static function hashBCryptPW($password){
		$options = ['cost' => 11];
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		return $hash;
	}
}