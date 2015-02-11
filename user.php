<?php
require_once 'src/facebook.php';


class fbuser{
	
	function __construct($app_id, $app_secret, $site_url){
		$this->app_id = $app_id;
		$this->app_secret = $app_secret;
		$this->site_url = $site_url;
	}


	function newfb(){
		$facebook = new Facebook( array('appId' => $this->app_id, 'secret' => $this->app_secret));
		return $facebook;
		
	}


	function getloginUrl(){
		$facebook = $this->newfb();
		$loginUrl = $facebook->getLoginUrl(array('scope' => 'email', 'redirect_uri' => $this->site_url ));
		return $loginUrl;
	}


	function getlogoutUrl(){
		$facebook = $this->newfb();
		$logoutUrl = $facebook->getLogoutUrl(array('next'=>'http://localhost/oovote/logout.php'));
		return $logoutUrl;
	}


	function get_user(){
		$facebook = $this->newfb();
		$user = $facebook -> getUser();

		if ($user){
			try{
				$user_profile = $facebook ->api('/me');
				return $user_profile;
			}
			catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;	
			}
		}
	}

	function capture_user_info(){
		$user_profile = $this->get_user();
		$fbid = $user_profile['id'];
		$name = $user_profile['name'];
		$email = $user_profile['email'];
		
		if($user_profile){
			//require_once('connection.php');
			try{
				include('connection.php');
				$sth = $dbh ->prepare("INSERT IGNORE INTO fblogin (fbid, name, email) VALUES (:fbid, :name, :email)");
				$sth -> execute(array(':fbid'=>$fbid, ':name'=>$name, ':email'=>$email));
					if($sth){
						$logoutUrl = $this->getlogoutUrl();
						echo "<a href =".$logoutUrl.">Log out</a>";
						if(!isset($_SESSION)){
							session_start();	
						}
						$_SESSION['fbid'] = $fbid;
						$_SESSION['name'] = $name;
						header("location:votepage.php");
					}

			}
	 
			catch(PDOException $e)
			{
				echo $e-> getMessage();
			}
		}
		else{
			$loginUrl =  $this->getloginUrl();
			echo "<a href =".$loginUrl.">Log in with Facebook</a>";
		}


	}


	

}


?>