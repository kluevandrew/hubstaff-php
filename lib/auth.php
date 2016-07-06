<?php 
	require_once "./helper/curl.php";
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
			if(is_file("./store/auth.txt"))
			{
				$file = fopen("./store/auth.txt","r");
				$auth_token = fread($file,filesize("./store/auth.txt"));
				fclose($file);
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
				$file = fopen("./store/auth.txt","w+");
				fwrite($file, $auth_token);
				fclose($file);
			}
			return $auth_token;			
			
		}
		
	}

?>