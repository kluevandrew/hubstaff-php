<?php 
	class organizations
	{
		public function getorganizations($offset, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["offset"] = $offset;

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["offset"] = "";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}
		public function find_organization($url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));	
			return $org_data;		
		}
		public function find_org_projects($offset, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["offset"] = $offset;

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["offset"] = "";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}
		public function find_org_members($offset, $url)
		{
			$fields["Auth-Token"] = $_SESSION['Auth-Token'];
			$fields["App-token"] = $_SESSION['App-Token'];
			$fields["offset"] = $offset;

			$parameters["Auth-Token"] = "header";
			$parameters["App-token"] = "header";
			$parameters["offset"] = "";
			
			$curl = new curl();

			$org_data = json_decode($curl->send($fields, $parameters, $url));		
			return $org_data;	
		}
	}

?>