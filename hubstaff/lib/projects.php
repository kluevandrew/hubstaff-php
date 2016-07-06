<?php 
	class projects
	{
		public function getprojects($status, $offset , $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["offset"] = $offset;
			if($status)
				$fields["status"] = $status;

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["offset"] = "";
			if($status)
				$parameters["status"] = "";
			
			$curl = new curl();

			$proj_data = json_decode($curl->send($fields, $parameters, $url));		
			return $proj_data;	
		}
		public function find_project($url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			
			$curl = new curl();

			$proj_data = json_decode($curl->send($fields, $parameters, $url));	
			return $proj_data;		
		}
		public function find_project_members($offset, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["offset"] = $offset;

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["offset"] = "";
			
			$curl = new curl();

			$proj_data = json_decode($curl->send($fields, $parameters, $url));		
			return $proj_data;	
		}
	}

?>