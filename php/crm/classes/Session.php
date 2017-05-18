<?
/**
* 	Manages user sessions
*/
class Session 
{
	//Put data in session
	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	//Does property exist?
	public static function exists($name)
	{
		return (isset($_SESSION[$name]));
	}

	//Get session variable
	public static function get($name)
	{
		if(self::exists($name)){
			return $_SESSION[$name];
		}else{
			return false;
		}
	}

	//Delete variable from session
	public static function delete($name)
	{
		//NOTE: return value is purely if an external function
		//needs to check if the key was even available
		if(self::exists($name)){
			unset($_SESSION[$name]);
			return true;
		}else{
			return false;
		}
	}

	//Output data on the page, delete once user refreshs
	//Returns if string is set
	public static function storeOnce($name, $string){
		if(!self::delete($name)){
			self::put($name, $string);
		}
	}

	public static function accessOnce($name){
		$string = self::get($name);
		if($string){
			self::delete($name);
		}else{
			$string = '';
		}

		return $string;
	}

}