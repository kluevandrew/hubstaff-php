<?php
namespace Hubstaff\Components;

class Notes extends AbstractComponent
{
    public function getnotes($starttime, $endtime, $offset, $options, $url)
    {
        $parameters = [];
        $parameters["start_time"] = $starttime;
        $parameters["stop_time"] = $endtime;

        if (isset($options['organizations'])) {
            $parameters['organizations'] = $options['organizations'];
        }
        if (isset($options['projects'])) {
            $parameters['projects'] = $options['projects'];
        }
        if (isset($options['users'])) {
            $parameters['users'] = $options['users'];
        }

        $parameters["offset"] = $offset;


        return $this->hubstaff->get($url, $parameters);
    }

    public function find_note($url)
    {
        return $this->hubstaff->get($url);
    }
}