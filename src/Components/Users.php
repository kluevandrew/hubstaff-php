<?php
namespace Hubstaff\Components;

class Users extends AbstractComponent
{
    public function getusers($organization_memberships, $project_memberships, $offset, $url)
    {
        $fields = [];
        $parameters = [];
        
        $fields["organization_memberships"] = (int)$organization_memberships;
        $fields["project_memberships"] = (int)$project_memberships;
        $fields["offset"] = $offset;

        $parameters["organization_memberships"] = "";
        $parameters["project_memberships"] = "";
        $parameters["offset"] = "";

        return $this->request($url, $fields, $parameters);
    }

    public function find_user($url)
    {
        return $this->request($url);
    }

    public function find_user_orgs($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }

    public function find_user_projects($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }

}