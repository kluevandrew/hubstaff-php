<?php 
	require_once $_SESSION['root']."helper/curl.php";
	class userauth
	{
		
		public $is_auth = 0;
		function __construct() {
			if(is_file("./store/auth.txt"))
			{
				$this->is_auth = 1;
			}else
			{
				$this->is_auth = 0;
			}
		}	
   		public function auth($app_token, $email, $password,$url)
		{
			if($_SESSION['Auth-Token'])
			{
				$auth_token = $_SESSION['Auth-Token'];
			}else
			{
				$fields["App-token"] = $app_token;
				$fields["email"] = $email;
				$fields["password"] = $password;
			
				$parameters["App-token"] = "header";
				$parameters["email"] = "";
				$parameters["password"] = "";
				$curl = new curl();

				$auth_data = json_decode($curl->send($fields, $parameters, $url, 1));
				$auth_token = $auth_data->user->auth_token;				
				
			}
			return $auth_token;			
			
		}
		
	}

?>