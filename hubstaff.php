<?php 
	include("config.php");
	class hubstaff
	{
		function __construct() {
			$_SESSION['Auth-Token'] = auth_token;
			$_SESSION['App-Token'] = App_Token;		
		}	
		public function auth()
		{
			$auth = new userauth();
			return $auth->auth(App_Token, email, password, BASE_URL.AUTH);		
		}
		public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
		{
			$users = new users();
			return $users->getusers($organization_memberships, $project_memberships, $offset, BASE_URL.USERS);
		}
		
		public function find_user($id)
		{
			$users = new users();
			return $users->find_user(sprintf(BASE_URL.FIND_USER,$id));
		}
		public function find_user_orgs($id,$offset = 0)
		{
			$users = new users();
			$users->find_user_orgs($offset, sprintf(BASE_URL.FIND_USER_ORG,$id));
		}
		public function find_user_projects($id,$offset = 0)
		{
			$users = new users();
			return $users->find_user_projects($offset, sprintf(BASE_URL.FIND_USER_PROJ,$id));
		}

		public function organizations($offset = 0)
		{
			$organizations = new organizations();
			return $organizations->getorganizations($offset,BASE_URL.ORGS);
		}
		
		public function find_organization($id)
		{
			$organizations = new organizations();
			return $organizations->find_organization(sprintf(BASE_URL.FIND_ORG,$id));
		}
		public function find_org_projects($id,$offset = 0)
		{
			$organizations = new organizations();
			return $organizations->find_org_projects($offset, sprintf(BASE_URL.FIND_ORG_PROJ,$id));
		}
		public function find_org_members($id,$offset = 0)
		{
			$organizations = new organizations();
			return $organizations->find_org_members($offset, sprintf(BASE_URL.FIND_ORG_MEMBERS,$id));
		}

		public function projects($active = '', $offset = 0)
		{
			$projects = new projects();
			return $projects->getprojects($active,$offset,BASE_URL.PROJS);
		}
		
		public function find_project($id)
		{
			$projects = new projects();
			return $projects->find_project(sprintf(BASE_URL.FIND_PROJ,$id));
		}
		
		public function find_project_members($id,$offset = 0)
		{
			$projects = new projects();
			$projects->find_project_members($offset, sprintf(BASE_URL.FIND_PROJ_MEMBERS,$id));
		}

		public function activities($start_time, $stop_time, $offset = 0, $options = array())
		{
			$activities = new activities();
			return $activities->getactivities($start_time, $stop_time, $offset = 0, $options ,BASE_URL.ACTIVITIES);
		}

		public function screenshots($start_time, $stop_time, $offset = 0, $options = array())
		{
			$screenshots = new screenshots();
			return $screenshots->getscreenshots($start_time, $stop_time, $offset = 0, $options ,BASE_URL.SCREENSHOTS);
		}

		public function notes($start_time, $stop_time, $offset = 0, $options = array())
		{
			$notes = new notes();
			return $notes->getnotes($start_time, $stop_time, $offset = 0, $options ,BASE_URL.NOTES);
		}

		public function find_note($id)
		{
			$projects = new notes();
			return $projects->find_note(sprintf(BASE_URL.FIND_NOTE,$id));
		}

		public function weekly_team($options = array())
		{
			$weekly = new weekly();
			return $weekly->weekly_team($options, BASE_URL.WEEKLY_TEAM);
		}
		public function weekly_my($options = array())
		{
			$weekly = new weekly();
			return $weekly->weekly_my($options, BASE_URL.WEEKLY_MY);
		}

		public function custom_date_team($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_TEAM);
		}

		public function custom_date_my($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_MY);
		}
		public function custom_member_team($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_TEAM);
		}
		public function custom_member_my($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_MY);
		}
		public function custom_project_team($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_TEAM);
		}
		public function custom_project_my($start_date, $end_date, $options = array())
		{
			$custom = new custom();
			return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_MY);
		}

	}

?>