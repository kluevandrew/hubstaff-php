<?php
namespace Hubstaff\Components;

class Organizations extends AbstractComponent
{
    public function getorganizations($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }

    public function find_organization($url)
    {
        return $this->request($url);
    }

    public function find_org_projects($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }

    public function find_org_members($offset, $url)
    {
        return $this->request($url, ['offset' => $offset], ['offset' => '']);
    }
}