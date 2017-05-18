<?
require_once __DIR__ .'/../core/init.php';

//Class for getting a per-page translation.
//If a string is not present in the language, NULL (an empty string)
//will be echoed to the user
class Translation
{
	public $db, $language_code, $table_name, $pageStrings, $headerStrings, $fileReferrer;

	public function __construct($user){
		$this->db = $user->db;
		$this->language_code = $this->getLanguage();
		$this->table_name = "translation_".$this->language_code;
		$this->fileReferrer = basename($_SERVER['SCRIPT_NAME']);

		$this->pageStrings = self::pdoToAssocArray($this->getPageStrings());
		$this->headerStrings = self::pdoToAssocArray($this->getHeaderStrings());
	}

	public static function pdoToAssocArray($DBObject){
		$translArr = array();

		if(!isset($DBObject) || $DBObject->error){
			return $translArr;
		}

		//TODO: refactor _count to be public and remove the _ for consistency
		for($i = 0; $i < $DBObject->_count; $i++){
			$translArr[$DBObject->results[$i]->string_id] = utf8_encode($DBObject->results[$i]->string);
		}

		return $translArr;
	}

	//get the user language
	private function getLanguage(){
		$lang = substr(locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2);
		if(Cookie::get(Config::get('cookie/language_cookie'))){
			$lang = Cookie::get(Config::get('cookie/language_cookie'));
		}

		$lang = substr($lang, 0, 2);

		return $lang;
	}

	//Get the page strings
	private function getPageStrings(){
		$query = "SELECT string_id, string FROM ".$this->table_name."
											 INNER JOIN pages ON pages.nice_name = ".$this->table_name.".page_id
											 WHERE pages.path_relative_root = ?";

		$pageStr = $this->db->query($query, array($this->fileReferrer));
		return $pageStr;
	}

	//get translated strings for header and footer
	private function getHeaderStrings(){
		$strings = $this->db->query("SELECT string_id, string FROM ".$this->table_name." WHERE page_id = 'GLOBAL'");
		return $strings;
	}

	//main function for getting a string to display on screen
	public function get($identifier){
		return $this->headerStrings[$identifier] ?? $this->pageStrings[$identifier] ?? "";
	}
}	