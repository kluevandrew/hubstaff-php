<?php
namespace Hubstaff\Components;

class Projects extends AbstractComponent
{
    public function getprojects($status, $offset, $url)
    {
        $fields = [];
        $parameters = [];
        
        $fields["offset"] = $offset;
        if ($status) {
            $fields["status"] = $status;
        }

        $parameters["offset"] = "";
        if ($status) {
            $parameters["status"] = "";
        }

        return $this->request($url, $fields, $parameters);
    }

    public function find_project($url)
    {
        return $this->request($url);
    }

    public function find_project_members($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }

}