<?php 
	class nots
	{
		public function getnotes($starttime, $endtime, $offset, $options, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["start_time"] = $starttime;
			$fields["stop_time"] = $endtime;

			if(isset($options['organizations']))
			{
				$fields['organizations'] = $options['organizations'];
				$parameters["organizations"] = "";
			}
			if(isset($options['projects']))
			{
				$fields['projects'] = $options['projects'];
				$parameters["projects"] = "";
			}
			if(isset($options['users']))
			{
				$fields['users'] = $options['users'];
				$parameters["users"] = "";
			}
			
			$fields["offset"] = $offset;
		
		
			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["start_time"] = "";
			$parameters["stop_time"] = "";
			$parameters["offset"] = "";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}

		public function find_note($url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			
			$curl = new curl();

			$user_data = json_decode($curl->send($fields, $parameters, $url));	
			return $user_data;		
		}
	}

?>