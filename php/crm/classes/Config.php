<?
/**
* Class for easily pulling data from GLOBALS array in core/init.php
*/
class Config
{
	public function get($path=null)
	{
		if($path){
			$validPath = false;
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			//recursive loop through path
			foreach ($path as $bit) {
				if(isset($config[$bit])){
					//value is available in $CONFIG
					$config = $config[$bit];
					$validPath = true;
				}
			}

			if($validPath){
				return $config;
			}else{
				return false;
			}
		}

		return false;
	}
}//end class Config