<?
require_once __DIR__ .'/../core/init.php';
/**
* Wrapper class for storing cookies
* NOTE: this will fall back on sessions automatically
* DO NOT USE SESSIONS directly. Only use cookies, which use sessions in the background.
* The reason is that the cookies may be turned off
* hence the fallback on the session
*/
class Cookie
{
	//get the value of a cookie, fallback to session if not available
	public static function get($name){
		if(isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}
		$value = Session::get($name);
		if($value != false){
			return $value;
		}
		return false;
	}

	public static function set($name, $value = ''){
		//one month valid
		setcookie($name, $value, time() + 2629743, '/');
		Session::put($name, $value);
	}

	public static function delete($name){
		setcookie($name, "", time() - 1, "/");
		Session::delete($name);
	}

}