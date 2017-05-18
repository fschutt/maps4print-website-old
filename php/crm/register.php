<?
require_once 'core/init.php';

if (Input::exists()) {
	$validate = new Validation();
	//set of rules to validate
	//NOTE: THESE must be in the order like in the HTML form
	//for easier lookup of errors in Javascript
	$rulesToValidate = array(
			"gender" => array(
				"required" => true
				),
			"surname" => array(
				"required" => true,
				"min" => 2,
				"max" => 30
				),
			"lastname" => array(
				"required" => true,
				"min" => 2,
				"max" => 30
				),
			"email" => array(
				"required" => true,
				"unique" => "users:email",
				"min" => 8,
				"max" => 50,
				"email" => true
				),
			"email_again" => array(
				"required" => true,
				"min" => 8,
				"max" => 30,
				"compare" => "email"
				),
			"password" => array(
				"required" => true,
				"min" => 8,
				"max" => 30,
				),
		);

	//Check if session is valid	
	if(Token::checkCSRF(Input::get('token'))){
		$validation = $validate->check($_POST, $rulesToValidate);

		if($validation->parseSuccess){
			$user = new User;
			$gender = 'MALE';
			switch (Input::get('gender')) {
				case 'female':
					$gender = 'FEMALE';
					break;
				case 'company':
					$gender = 'COMPANY';
					break;
			}

			try {
				$user->create(array(
					'type' => $gender,
					'surname' => Input::get('surname'),
					'lastname' => Input::get('lastname'),
					'email' => Input::get('email'),
					'password' => Hash::hashBCryptPW(Input::get('password'))
					));
			} catch (Exception $e) {
				//Could not register user
				//die($e->getMessage());
				die();
			}

			$user->login(Input::get('email'));
			Session::storeOnce('registered', 'Registered successfully');
			header("Location: ./../../account.php");
		}
	}
}