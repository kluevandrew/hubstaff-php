<?php
namespace Hubstaff\Components;

use Hubstaff\Curl;

class Users extends AbstractComponent
{
    public function getusers($organization_memberships, $project_memberships, $offset, $url)
    {
        $fields["organization_memberships"] = (int)$organization_memberships;
        $fields["project_memberships"] = (int)$project_memberships;
        $fields["offset"] = $offset;

        $parameters["organization_memberships"] = "";
        $parameters["project_memberships"] = "";
        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function find_user($url)
    {
        return json_decode($this->request([], [], $url));
    }

    public function find_user_orgs($offset, $url)
    {
        $fields["offset"] = $offset;
        $parameters["offset"] = "header";

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function find_user_projects($offset, $url)
    {
        $fields["offset"] = $offset;
        $parameters["offset"] = "header";

        return json_decode($this->request($fields, $parameters, $url));
    }
}

?>