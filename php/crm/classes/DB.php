<?
/**
* Database Wrapper for easy selection from a database
*/
class DB
{
	private static $_instance = null;

	private $_pdo,
			$_query;
			
	public 	$count = 0;

	public $results, $errorStr, $error = false;

	//Get class singleton instance
	public static function getInstance()
	{
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	//Connect to database if no one exists
	private function __construct()
	{
		$hostName = Config::get('mysql/host');
		$dbName = Config::get('mysql/db');
		$userConnect = Config::get('mysql/username');
		$passwordConnect = Config::get('mysql/password');

		if(!$hostName && !$dbName && !$userConnect && !$passwordConnect){
			$this->error = true;
			$this->errorStr = "Database connection invalid.";
		}

		try {
			$this->_pdo = new PDO('mysql:host='.$hostName.';dbname='.$dbName, $userConnect, $passwordConnect);
		} catch (PDOException $e) {
			$this->error = true;
			$this->errorStr = $e->getMessage();
		}

		$this->clearUserObject();
	}

	public function clearUserObject(){
		//clear everything except pdo
		$this->error = false;
		$this->_query = NULL;
		$this->_count = NULL;
		$this->results = NULL;
	}

	//Querying function
	public function query($sql, $params = array())
	{
		$this->clearUserObject();
		$this->_query = $this->_pdo->prepare($sql);
		if($this->_query == NULL){
			$this->error = true;
			$this->errorStr = "Could not prepare PDO statement";
			return $this;
		}

		//Bind parameters to query if there are any
		if(count($params)){
			$pos = 1;
			foreach ($params as $param) {
				$this->_query->bindValue($pos, $param);
				$pos++;
			}
		}

		if(!$this->_query->execute()){
			$this->clearUserObject();
			$this->error = true;
			$this->errorStr = "Could not execute query: ".$sql;
			return $this;
		}

		$this->_count = $this->_query->rowCount();

		if($this->_count == 0){
			$this->clearUserObject();
			$this->error = true;
			$this->errorStr = "No results.";
			return $this;
		}

		$this->results = $this->_query->fetchAll(PDO::FETCH_OBJ);

		return $this;
	}

	//There are no wrappers around select and delete, because
	//these statements are very simple and you can just use
	//query() to execute the SQL.
	//The insert and update queries are a bit more difficult to do,
	//this is why we only have wrappers for them
	public function insert($table, $values=array())
	{
		$this->error = false;

		$valuesCount = count($values);
		if(!$valuesCount > 0){
			$this->error = true;
			$this->errorStr = "No values given for INSERT query on ".$table;
			return $this;
		}

		//Build SQL string
		$sqlString = "INSERT INTO ".$table." (";

		$count = 1;
		foreach ($values as $key => $value) {
			if($count != $valuesCount){
				$sqlString .= $key.", ";
			}else{
				$sqlString .= $key;
			}
			$count++;
		}

		$sqlString.=") VALUES (";

		$count = 1;
		foreach ($values as $key => $value) {
			if($count != $valuesCount){
				$sqlString .= "?, ";
			}else{
				$sqlString .= "?";
			}
			$count++;
		}

		$sqlString = rtrim($sqlString, ",");
		$sqlString.=");";
		//End building SQL string

		$this->query($sqlString, $values);
		return $this;
	}

	public function update($table, $columns = array(), $id=array())
	{
		$this->error = false;
		$columnCount = count($columns);
		$idsCount = count($id);

		if($columnCount == 0 || $idsCount == 0){
			$this->error = true;
			$this->errorStr = "Invalid update values in UPDATE ".$table;
			return $this;
		}

		$sqlString = "UPDATE ".$table." SET ";

		$count = 1;
		foreach ($columns as $key => $value) {
			if($count != $columnCount){
				$sqlString .= $key."=?, ";
			}else{
				$sqlString .= $key."=? ";
			}
			$count++;
		}

		$sqlString .= " WHERE ";

		$count = 1;
		foreach ($id as $key => $value) {
			if($count != $idsCount){
				$sqlString .= $key."=".$value." AND ";
			}else{
				$sqlString .= $key."=".$value;
			}
			$count++;
		}

		$sqlString .= ";";
		$this->query($sqlString, $columns);

		return $this;
	}
	
}