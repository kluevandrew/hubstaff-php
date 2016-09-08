<?php
namespace Hubstaff\Components;

class Users extends AbstractComponent
{
    public function getUsers($organization_memberships, $project_memberships, $offset, $url)
    {
        $parameters = [];

        $parameters["organization_memberships"] = (int)$organization_memberships;
        $parameters["project_memberships"] = (int)$project_memberships;
        $parameters["offset"] = $offset;

        return $this->hubstaff->get($url, $parameters);
    }

    public function find_user($url)
    {
        return $this->hubstaff->get($url);
    }

    public function find_user_orgs($offset, $url)
    {
        return $this->hubstaff->get($url, ['offset' => $offset]);
    }

    public function find_user_projects($offset, $url)
    {
        return $this->hubstaff->get($url, ['offset' => $offset]);
    }

}