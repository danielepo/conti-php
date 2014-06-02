<?php
////////////////////////////////////////////////////////////////////////////////////////
// Class: sentry
// Purpose: Control access to pages
///////////////////////////////////////////////////////////////////////////////////////
class sentry {
	
	var $loggedin = false;	//	Boolean to store whether the user is logged in
	var $userdata;			//  Array to contain user's data
	
	function sentry(){
		session_start();
		header("Cache-control: private"); 
	}
	
	//======================================================================================
	// Log out, destroy session
	function logout(){
		unset($this->userdata);
		session_destroy();
		return true;
	}

	//======================================================================================
	// Log in, and either redirect to goodRedirect or badRedirect depending on success
	function checkLogin ($group = 10){
		return $this->login('','',$group,'','failed.php');
	}
	
	function login($user = '',$pass = '',$group = 10,$goodRedirect = '',$badRedirect = ''){

		// Include database and validation classes, and create objects
		require_once('DbUserManagement.php');
		require_once('Validator.php');
		$validate = new Validator();
		$userManagement = new DbUserManagement();
		
		// If user is already logged in then check credentials
		if (isset($_SESSION['user']) && isset($_SESSION['pass'])){

			// Validate session data
			if (!$validate->validateTextOnly($_SESSION['user'])){return false;}
			//if (!$validate->validateTextOnly($_SESSION['pass'])){return false;}

			$getUser = $userManagement->CheckPermission($_SESSION['user'],$_SESSION['pass'],$group);
			
			if ($userManagement->getNumRows($getUser) > 0){
				// Existing user ok, continue
				if ($goodRedirect != '') { 
					header("Location: ".$goodRedirect."?".strip_tags(session_id())) ;
				}			
				return true;
			}else{
				// Existing user not ok, logout
				$this->logout();
				return false;
			}
			
		// User isn't logged in, check credentials
		}else{	
			// Validate input
			if (!$validate->validateTextOnly($user)){return false;}
			if (!$validate->validateTextOnly($pass)){return false;}

			// Look up user in DB
			
			$getUser = $userManagement->CheckCypherPermission($user,$pass,$group);

			$this->userdata = $userManagement->fetchArray($getUser,MYSQL_ASSOC);
				
			if ($userManagement->getNumRows($getUser) > 0){
				// Login OK, store session details
				// Log in
				$_SESSION["user"] = $user;
				$_SESSION["pass"] = $this->userdata['pass'];
				$_SESSION["thegroup"] = $this->userdata['thegroup'];
								
				if ($goodRedirect) { 
					header("Location: ".$goodRedirect."?".strip_tags(session_id())) ;
				}
				return true;

			}else{
				// Login BAD
				unset($this->userdata);
				if ($badRedirect) { 
			//		header("Location: ".$badRedirect) ;
					
					echo "<br>".md5($pass)."<br>";
					echo $user."-".$pass;
				}		
				return false;
			}
		}			
	}
}	
?>