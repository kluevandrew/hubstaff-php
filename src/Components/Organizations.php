<?php
namespace Hubstaff\Components;

class Organizations extends AbstractComponent
{
    public function getorganizations($offset, $url)
    {
        $fields["offset"] = $offset;
        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function find_organization($url)
    {
        return json_decode($this->request([], [], $url));
    }

    public function find_org_projects($offset, $url)
    {
        $fields = [];
        $parameters = [];
        $fields["offset"] = $offset;
        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function find_org_members($offset, $url)
    {
        $fields["offset"] = $offset;

        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }
    
}