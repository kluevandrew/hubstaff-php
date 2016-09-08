<?php

namespace Hubstaff\Components;

/**
 * Class Activities
 * @package Hubstaff\Components
 */
class Activities extends AbstractComponent
{
    /**
     * @param $startTime
     * @param $endTime
     * @param $offset
     * @param $options
     * @param $url
     * @return mixed
     */
    public function getActivities($startTime, $endTime, $offset, $options, $url)
    {
        $parameters = [];

        $parameters['start_time'] = $startTime;
        $parameters['stop_time'] = $endTime;

        if (isset($options['organizations'])) {
            $parameters['organizations'] = $options['organizations'];
        }
        if (isset($options['projects'])) {
            $parameters['projects'] = $options['projects'];
        }
        if (isset($options['users'])) {
            $parameters['users'] = $options['users'];
        }

        $parameters['offset'] = $offset;


        return $this->hubstaff->get($url, $parameters);
    }
}
