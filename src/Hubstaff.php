<?php

namespace Hubstaff;

use Hubstaff\Statistic\StatisticStorageInterface;
use Hubstaff\Statistic\TempFileStorage;
use Hubstaff\Transport\CurlTransport;
use Hubstaff\Transport\TransportInterface;
use Hubstaff\Components\Activities;
use Hubstaff\Components\Auth;
use Hubstaff\Components\Custom;
use Hubstaff\Components\Notes;
use Hubstaff\Components\Organizations;
use Hubstaff\Components\Projects;
use Hubstaff\Components\Screenshots;
use Hubstaff\Components\Users;
use Hubstaff\Components\Weekly;

/**
 * Class Hubstaff
 */
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

    /**
     * @var string
     */
    protected $appToken;

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var StatisticStorageInterface
     */
    protected $statisticStorage;

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
     * HubstaffClient constructor.
     * @param string $appToken
     * @param TransportInterface|null $transport
     * @param StatisticStorageInterface $statisticStorage
     */
    public function __construct(
        $appToken,
        TransportInterface $transport = null,
        StatisticStorageInterface $statisticStorage = null
    ) {
        $this->appToken = $appToken;
        $this->transport = $transport ? $transport : $this->createDefaultTransport();
        $this->statisticStorage = $statisticStorage ? $statisticStorage : $this->createDefaultStatisticStorage();

        $this->activities = new Activities($this);
        $this->custom = new Custom($this);
        $this->notes = new Notes($this);
        $this->organizations = new Organizations($this);
        $this->projects = new Projects($this);
        $this->screenshots = new Screenshots($this);
        $this->users = new Users($this);
        $this->weekly = new Weekly($this);
    }

    /**
     * @return string
     */
    public function getAppToken()
    {
        return $this->appToken;
    }

    /**
     * @param string $appToken
     */
    public function setAppToken($appToken)
    {
        $this->appToken = $appToken;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * @return CurlTransport
     */
    protected function createDefaultTransport()
    {
        return new CurlTransport(self::BASE_URL);
    }

    /**
     * @return TempFileStorage
     */
    protected function createDefaultStatisticStorage()
    {
        return new TempFileStorage($this);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function get($url, array $data = [], array $headers = [])
    {
        $this->statisticStorage->incrementRequests();

        $headers = array_merge($headers, [
            'App-token' => $this->getAppToken(),
            'Auth-token' => $this->getAuthToken(),
        ]);

        return $this->parseResponse($this->transport->get($url, $data, $headers));
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function post($url, array $data = [], array $headers = [])
    {
        $this->statisticStorage->incrementRequests();

        $headers = array_merge($headers, [
            'App-token' => $this->getAppToken(),
            'Auth-token' => $this->getAuthToken(),
        ]);

        return $this->parseResponse($this->transport->post($url, $data, $headers));
    }

    /**
     * @param string $response
     * @return mixed
     */
    protected function parseResponse($response)
    {
        $response = json_decode($response, true);
        if (!$response) {
            throw new \RuntimeException();
        }

        if (isset($response['error'])) {
            throw new \RuntimeException($response['error']);
        }

        return $response;
    }

    /**
     * @void
     */
    public function saveStatistics()
    {
        $this->statisticStorage->save();
    }

    /**
     * @void
     */
    public function reloadStatistics()
    {
        $this->statisticStorage->reload();
    }

    /**
     * Destructor
     * @void
     */
    public function __destruct()
    {
        $this->saveStatistics();
    }

    /**
     * @param $email
     * @param $password
     * @return string|void
     */
    public function auth($email, $password)
    {
        $this->statisticStorage->incrementAuthRequest();

        return $this->post(
            self::AUTH,
            ['email' => $email, 'password' => $password],
            ['App-token' => $this->getAppToken()]
        )['auth_token'];
    }

    public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
    {
        return $this->users->getUsers($organization_memberships, $project_memberships, $offset, self::USERS);
    }

    public function find_user($id)
    {
        return $this->users->find_user(sprintf(self::FIND_USER, $id));
    }

    public function find_user_orgs($id, $offset = 0)
    {
        return $this->users->find_user_orgs($offset, sprintf(self::FIND_USER_ORG, $id));
    }

    public function find_user_projects($id, $offset = 0)
    {
        return $this->users->find_user_projects($offset, sprintf(self::FIND_USER_PROJ, $id));
    }

    public function organizations($offset = 0)
    {
        return $this->organizations->getorganizations($offset, self::ORGS);
    }

    public function find_organization($id)
    {
        return $this->organizations->find_organization(sprintf(self::FIND_ORG, $id));
    }

    public function find_org_projects($id, $offset = 0)
    {
        return $this->organizations->find_org_projects($offset, sprintf(self::FIND_ORG_PROJ, $id));
    }

    public function find_org_members($id, $offset = 0)
    {
        return $this->organizations->find_org_members($offset, sprintf(self::FIND_ORG_MEMBERS, $id));
    }

    public function projects($active = '', $offset = 0)
    {
        return $this->projects->getprojects($active, $offset, self::PROJS);
    }

    public function find_project($id)
    {
        return $this->projects->find_project(sprintf(self::FIND_PROJ, $id));
    }

    public function find_project_members($id, $offset = 0)
    {
        return $this->projects->find_project_members($offset, sprintf(self::FIND_PROJ_MEMBERS, $id));
    }

    public function activities($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->activities->getActivities($start_time, $stop_time, $offset, $options, self::ACTIVITIES);
    }

    public function screenshots($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->screenshots->getscreenshots($start_time, $stop_time, $offset, $options, self::SCREENSHOTS);
    }

    public function notes($start_time, $stop_time, $offset = 0, $options = [])
    {
        return $this->notes->getnotes($start_time, $stop_time, $offset, $options, self::NOTES);
    }

    public function find_note($id)
    {
        return $this->notes->find_note(sprintf(self::FIND_NOTE, $id));
    }

    public function weekly_team($options = [])
    {
        return $this->weekly->weekly_team($options, self::WEEKLY_TEAM);
    }

    public function weekly_my($options = [])
    {
        return $this->weekly->weekly_my($options, self::WEEKLY_MY);
    }

    public function custom_date_team($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_DATE_TEAM);
    }

    public function custom_date_my($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_DATE_MY);
    }

    public function custom_member_team($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_MEMBER_TEAM);
    }

    public function custom_member_my($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_MEMBER_MY);
    }

    public function custom_project_team($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_PROJECT_TEAM);
    }

    public function custom_project_my($start_date, $end_date, $options = [])
    {
        return $this->custom->customReport($start_date, $end_date, $options, self::CUSTOM_PROJECT_MY);
    }

    /**
     * @return StatisticStorageInterface
     */
    public function stats()
    {
        return $this->statisticStorage;
    }
}