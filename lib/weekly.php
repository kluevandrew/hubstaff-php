<?php 
	class weekly
	{
		public function weekly_team($options, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			if(isset($options['date']))
			{
				$fields['date'] = $options['date'];
				$parameters["date"] = "";
			}
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
					
		
			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			
			$curl = new curl();
			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}

		public function weekly_my($options, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			if(isset($options['date']))
			{
				$fields['date'] = $options['date'];
				$parameters["date"] = "";
			}
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
				
		
			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}

	}

?>