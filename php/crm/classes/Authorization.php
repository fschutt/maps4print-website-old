<?
require_once __DIR__ .'/../core/init.php';

class Authorization 
{
	public static function checkAndRedirect(){
		//look up if the current file is protected
		$fileReferrer = basename($_SERVER['SCRIPT_NAME']);
		$customer = new User;
		$redirect = $customer->db->query("SELECT * FROM pages WHERE path_relative_root = ?", array($fileReferrer));

		if(!$redirect->error){
			$redirect = $redirect->results[0];

			if(isset($redirect->restricted_group_id)){
				//check if the user has the permissions to view the page
				$userIDRnd = Cookie::get(Config::get('cookie/cookie_name'));
				if(isset($userIDRnd)){
					//check if the user is logged in on this device
					$realID = $customer->getRealID($userIDRnd);
					if($realID->count >= 0 && !$realID->error){
						$realID = $realID->results[0];

						//check if the group id associated with this user matches the group id associated with this page
						if($realID->group_id == $redirect->restricted_group_id){
							//user can view this page
							return;
						}else{
							$redirectLocation = $customer->db->query("SELECT path_relative_root FROM pages WHERE id = ?", 
																	  array($redirect->redirect_page_id_error));
							if(isset($redirectLocation) && !$redirectLocation->error){
								//redirect to page on error
								header("Location: ".$redirectLocation->results[0]->path_relative_root);
							}
						}
					}
				}
			}

			//fallback on any error
			header("Location: login.php");
		}

		//no restriction set: just output the page
	}
}