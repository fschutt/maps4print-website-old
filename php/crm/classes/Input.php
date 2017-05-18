<?
require_once __DIR__ .'/../core/init.php';

/**
* 
*/
class Input
{
	public static function exists($type='post')
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST));
				break;
			case 'get':
				return (!empty($_GET));
				break;
			default:
				return false;
				break;
		}
	}

	public static function get($string)
	{
		if(isset($_POST[$string])){
			return $_POST[$string];
		}else if(isset($_GET[$string])){
			return $_GET[$string];
		}
		return '';
	}
}