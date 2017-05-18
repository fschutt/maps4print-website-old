<?
require_once __DIR__ .'/../core/init.php';

/**
* Validation class. Validates incoming and outgoing data.
*/
class Validation
{
	public $parseSuccess = false;
	public $errors = array();
	public $dbConn = null;

	public function __construct(){
		$dbConn = DB::getInstance();
		if($dbConn->error){
			echo "Error connecting to database.";
		}
	}

	//Iterate through given rules for the values ($values = $_POST or $_GET)
	//and validate them accordingly
	//@return: E_REQUIRED, E_TOO_SHORT, E_TOO_LONG, E_KEY_EXISTS_DB, E_EMAIL_NOT_VALID, E_VERIFY_NOT_MATCH
	public function check($values = array(), $items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $value) {
				echo "Parsing rule<br/>";
				switch ($rule) {
					case 'required':
						if(!$this->isNotEmpty($values, $item)){ return $this; }
						break;
					case 'min':
						if(!$this->moreThanChars($values, $item, $value)){ return $this; }
						break;
					case 'max':
						if(!$this->lessThanChars($values, $item, $value)){ return $this; }
						break;
					case 'unique':
						$tableAndColumn = explode(":", $value);
						if(!$this->isUniqueDB($values, $item, $tableAndColumn[0], $tableAndColumn[1])){ return $this; }
						break;
					case 'compare':
						if(!$this->charEqualsChars($values, $item, $values, array_search($value, array_keys($values)) )){ return $this; }
						break;
					case 'email':
						if(!$this->checkEMail($values, $item)){ return $this; }
						break;
				}
			}
		}

		return $this;
	}

	private function isNotEmpty($array = array(), $key)
	{
		if($array[$key]){
			if(!empty($array[$key])){
				$this->parseSuccess = true;
				return true;
			}
		}

		$errors["E_REQUIRED"] = $key;
		$this->parseSuccess = false;
		return false;
	}

	private function moreThanChars($array=array(), $key, $numChars)
	{		
		if(strlen(utf8_decode($array[$key])) >= $numChars){
			$this->parseSuccess = true;
			return true;
		}

		$errors["E_TOO_SHORT"] = $key;
		$this->parseSuccess = false;
		return false;
	}

	private function lessThanChars($array=array(), $key, $numChars)
	{
		if(strlen(utf8_decode($array[$key])) < $numChars){
			$this->parseSuccess = true;
			return true;
		}

		$errors["E_TOO_LONG"] = $key;
		$this->parseSuccess = false;
		return false;
	}

	private function isUniqueDB($array = array(), $key, $tableName, $columnName)
	{
		$sqlQuery = "SELECT * FROM ".$tableName." WHERE ".$columnName." = ?;";

		$results = DB::getInstance()->query($sqlQuery, array($array[$key]));
		if($results->error){
			$this->parseSuccess = true;
			return true;
		}

		$errors["E_KEY_EXISTS_DB"] = $key;
		$this->parseSuccess = false;
		return false;
	}

	private function checkEMail($array = array(), $key)
	{
		//NOTE: do not try filter(), it does not account for umlauts in emails
		$email = $array[$key];
		$pattern = "/^.*?@.*?\..*?$/";

		if($email){
			if (preg_match($pattern, $email)) {
				$domain = explode("@", $email);
				//check domain
				if (checkdnsrr(end($domain), 'MX')) {
					$this->parseSuccess = true;
					return true;
				}
			}
		}

		$errors["E_EMAIL_NOT_VALID"] = $key;
		$this->parseSuccess = false;
		return false;
	}

	private function charEqualsChars($array1 = array(), $key1, $array2 = array(), $key2)
	{
		$string1 = $array1[$key1];

		//This has to be done since we need the id of the
		//key that failed. A bit messy.
		$keys2 = array_keys($array2);
		$actualKey2 = $keys2[$key2];
		$string2 = $array2[$actualKey2];

		if($string1 && $string2){
			if(strcmp($string1, $string2) == 0){
				$this->parseSuccess = true;
				return true;
			}
		}

		//See? We need to store the key2 (the last email that did not match)
		//this is why we need the numeric lookup for consistency
		$errors["E_VERIFY_NOT_MATCH"] = $key2;
		$this->parseSuccess = false;
		return false;
	}

}