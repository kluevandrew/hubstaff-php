<?php

namespace Hubstaff;

use Hubstaff\Components\AbstractComponent;
use Hubstaff\Components\Activities;
use Hubstaff\Components\Auth;
use Hubstaff\Components\Custom;
use Hubstaff\Components\Notes;
use Hubstaff\Components\Organizations;
use Hubstaff\Components\Projects;
use Hubstaff\Components\Screenshots;
use Hubstaff\Components\Users;
use Hubstaff\Components\Weekly;

class Hubstaff
{
    const BASE_URL = "https://api.hubstaff.com/v1/";
    const AUTH = "auth";
    const USERS = "users";
    const FIND_USER = "users/%d";
    const FIND_USER_ORG = "users/%d/organizations";
    const FIND_USER_PROJ = "users/%d/projects";

    const ORGS = "organizations";
    const FIND_ORG = "organizations/%d";
    const FIND_ORG_PROJ = "organizations/%d/projects";
    const FIND_ORG_MEMBERS = "organizations/%d/members";

    const PROJS = "projects";
    const FIND_PROJ = "projects/%d";
    const FIND_PROJ_MEMBERS = "projects/%d/members";

    const ACTIVITIES = "activities";

    const SCREENSHOTS = "screenshots";

    const NOTES = "notes";
    const FIND_NOTE = "notes/%d";

    const WEEKLY_TEAM = "weekly/team";
    const WEEKLY_MY = "weekly/my";

    const CUSTOM_DATE_TEAM = "custom/by_date/team";
    const CUSTOM_DATE_MY = "custom/by_date/MY";
    const CUSTOM_MEMBER_TEAM = "custom/by_member/team";
    const CUSTOM_MEMBER_MY = "custom/by_member/my";
    const CUSTOM_PROJECT_TEAM = "custom/by_project/team";
    const CUSTOM_PROJECT_MY = "custom/by_project/my";

    protected $app_token;
    protected $auth_token;

    protected $activities;
    protected $auth;
    protected $custom;
    protected $notes;
    protected $organizations;
    protected $projects;
    protected $screenshots;
    protected $users;
    protected $weekly;

    /**
     * Hubstaff constructor.
     * @param $app_token
     */
    public function __construct($app_token)
    {
        $this->app_token = $app_token;

        $this->activities = new Activities($this);
        $this->auth = new Auth($this);
        $this->custom = new Custom($this);
        $this->notes = new Notes($this);
        $this->organizations = new Organizations($this);
        $this->projects = new Projects($this);
        $this->screenshots = new Screenshots($this);
        $this->users = new Users($this);
        $this->weekly = new Weekly($this);
    }

    public function auth($email, $password)
    {
        return $this->auth->auth($this->app_token, $email, $password, self::BASE_URL . self::AUTH);
    }

    public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
    {
        return $this->users->getusers($organization_memberships, $project_memberships, $offset, self::BASE_URL . self::USERS);
    }

    public function find_user($id)
    {
        return $this->users->find_user(sprintf(self::BASE_URL . self::FIND_USER, $id));
    }

    public function find_user_orgs($id, $offset = 0)
    {
        return $this->users->find_user_orgs($offset, sprintf(self::BASE_URL . self::FIND_USER_ORG, $id));
    }

    public function find_user_projects($id, $offset = 0)
    {
        return $this->users->find_user_projects($offset, sprintf(self::BASE_URL . self::FIND_USER_PROJ, $id));
    }

    public function organizations($offset = 0)
    {
        return $this->organizations->getorganizations($offset, self::BASE_URL . self::ORGS);
    }

    public function find_organization($id)
    {
        return $this->organizations->find_organization(sprintf(self::BASE_URL . self::FIND_ORG, $id));
    }

    public function find_org_projects($id, $offset = 0)
    {
        return $this->organizations->find_org_projects($offset, sprintf(self::BASE_URL . self::FIND_ORG_PROJ, $id));
    }

    public function find_org_members($id, $offset = 0)
    {
        return $this->organizations->find_org_members($offset, sprintf(self::BASE_URL . self::FIND_ORG_MEMBERS, $id));
    }

    public function projects($active = '', $offset = 0)
    {
        return $this->projects->getprojects($active, $offset, self::BASE_URL . self::PROJS);
    }

    public function find_project($id)
    {
        return $this->projects->find_project(sprintf(self::BASE_URL . self::FIND_PROJ, $id));
    }

    public function find_project_members($id, $offset = 0)
    {
        return $this->projects->find_project_members($offset, sprintf(self::BASE_URL . self::FIND_PROJ_MEMBERS, $id));
    }

    public function activities($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->activities->getactivities($start_time, $stop_time, $offset = 0, $options, self::BASE_URL . self::ACTIVITIES);
    }

    public function screenshots($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->screenshots->getscreenshots($start_time, $stop_time, $offset = 0, $options, self::BASE_URL . self::SCREENSHOTS);
    }

    public function notes($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->notes->getnotes($start_time, $stop_time, $offset = 0, $options, self::BASE_URL . self::NOTES);
    }

    public function find_note($id)
    {
        return $this->notes->find_note(sprintf(self::BASE_URL . self::FIND_NOTE, $id));
    }

    public function weekly_team($options = [])
    {
        return $this->weekly->weekly_team($options, self::BASE_URL . self::WEEKLY_TEAM);
    }

    public function weekly_my($options = [])
    {
        return $this->weekly->weekly_my($options, self::BASE_URL . self::WEEKLY_MY);
    }

    public function custom_date_team($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_DATE_TEAM);
    }

    public function custom_date_my($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_DATE_MY);
    }

    public function custom_member_team($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_MEMBER_TEAM);
    }

    public function custom_member_my($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_MEMBER_MY);
    }

    public function custom_project_team($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_PROJECT_TEAM);
    }

    public function custom_project_my($start_date, $end_date, $options = [])
    {
        return $this->custom->custom_report($start_date, $end_date, $options, self::BASE_URL . self::CUSTOM_PROJECT_MY);
    }

    /**
     * @return mixed
     */
    public function getAppToken()
    {
        return $this->app_token;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * @param mixed $auth_token
     */
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
    }
}
