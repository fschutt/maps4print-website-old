<?
require_once __DIR__ .'/../core/init.php';

/**
* User class
*/
class User
{
	public $db;
	public $data;
	public $isAdmin = false;

	function __construct($user = null)
	{
		$this->db = DB::getInstance();
	}

	public function create($fields = array())
	{
		if(!$this->db->insert('users', $fields)){
			throw new Exception("Problem registering user.", 1);
		}
	}

	public function verify($email, $password){
		$databasePW = $this->db->query('SELECT * FROM users WHERE email = ?', array($email));
		if(!$databasePW->error){
			return password_verify($password, $databasePW->results[0]->password);
		}else{
			return false;
		}
	}

	public function login($email){
		$userDetails = $this->db->query('SELECT id FROM users WHERE email = ?', array($email));
		$_userID = $userDetails->results[0]->id;

		//Set cookie and session with unique ID. This way we don't store any security-related details on the users computer.
		//Modifying the cookie will just log the user out.
		if(isset($_userID)){
			//Store the user ID both in a cookie and in a session
			//If the browser doesn't enable cookies, we can still use the session
			$randomID = sha1(uniqid());
			$this->db->insert('logged_in_users', array('user_id' => $_userID, 'hash' =>$randomID));
			Cookie::set(Config::get('cookie/cookie_name'), $randomID);
			return $randomID;
		}
	}

	public function getRealID($hash){
		return $this->db->query('SELECT * FROM users INNER JOIN logged_in_users ON users.id = logged_in_users.user_id WHERE logged_in_users.hash = ? LIMIT 1;', array($hash));
	}

	//Put all data for the user in $this->data
	public function getAllData($hash){
		$this->data = $this->getRealID($hash)->results;
	}

	public function isLoggedIn($hash){
		$loggedInUser = $this->db->query('SELECT COUNT(user_id) AS total FROM logged_in_users WHERE hash = ?', array($hash));
		if($loggedInUser->results[0]->total > 0){
			return true;
		}
		return false;
	}

	public function logout(){
		//delete by randomID and cookies
		//TODO
	}
}