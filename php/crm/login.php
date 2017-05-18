<?
require_once 'core/init.php';

//If user is logged in, redirect
$userIDRnd = Cookie::get(Config::get('cookie/cookie_name'));
if($userIDRnd){
	if(User::isAdministrator($userIDRnd)){
		header("Location: admin.php");
	}else{
		header("Location: account.php");
	}
}

if (Input::exists()) {
	$validate = new Validation();
	//set of rules to validate
	$rulesToValidate = array(
			"email" => array("required" => true),
			"password" => array("required" => true)
			);

	$validation = $validate->check($_POST, $rulesToValidate);

	//Check if session is valid	
	if(Token::checkCSRF(Input::get('token'))){
		if($validation->parseSuccess){

			$user = new User();

			if($user->verify(Input::get('email'), Input::get('password'))){
				$randomID = $user->login(Input::get('email'));
				header('Location: '.__DIR__.'../../account.php');
			}

		}else{
			foreach ($validation->errors as $error) {
				echo $error."<br>";
			}
		}
	}
}
