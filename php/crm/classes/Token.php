<?
require_once __DIR__ .'/../core/init.php';

/**
* 	Class to generate tokens on each page refresh to prevent CSRF
*/
class Token
{
	//Generate a unique token to prevent CSRF
	public static function generate()
	{
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}

	//Get token from session, check if it is the same as in the form
	//If not, it is CSRF
	public static function checkCSRF($token)
	{
		$tokenName = Config::get('session/token_name');

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			Session::delete($tokenName);
			return true;
		}

		return false;
	}
}