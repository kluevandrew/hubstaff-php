<?php
namespace Hubstaff\Components;

class Projects extends AbstractComponent
{
    public function getprojects($status, $offset, $url)
    {
        $parameters = [];

        $parameters["offset"] = $offset;
        if ($status) {
            $parameters["status"] = $status;
        }

        return $this->hubstaff->get($url, $parameters);
    }

    public function find_project($url)
    {
        return  $this->hubstaff->get($url);
    }

    public function find_project_members($offset, $url)
    {
        return $this->hubstaff->get($url, ['offset' => $offset]);
    }

}