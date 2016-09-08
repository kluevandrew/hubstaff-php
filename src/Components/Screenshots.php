<?php
namespace Hubstaff\Components;

class Screenshots extends AbstractComponent
{
    public function getscreenshots($starttime, $endtime, $offset, $options, $url)
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

}