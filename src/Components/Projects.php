<?php
namespace Hubstaff\Components;

class Projects extends AbstractComponent
{
    public function getprojects($status, $offset, $url)
    {
        $fields["offset"] = $offset;
        if ($status) {
            $fields["status"] = $status;
        }

        $parameters["offset"] = "";
        if ($status) {
            $parameters["status"] = "";
        }

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function find_project($url)
    {
        return json_decode($this->request([], [], $url));
    }

    public function find_project_members($offset, $url)
    {
        $fields["offset"] = $offset;

        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }

}