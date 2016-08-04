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
        $fields = [];
        $parameters = [];
        
        $fields['start_time'] = $startTime;
        $fields['stop_time'] = $endTime;

        if (isset($options['organizations'])) {
            $fields['organizations'] = $options['organizations'];
            $parameters['organizations'] = '';
        }
        if (isset($options['projects'])) {
            $fields['projects'] = $options['projects'];
            $parameters['projects'] = '';
        }
        if (isset($options['users'])) {
            $fields['users'] = $options['users'];
            $parameters['users'] = '';
        }

        $fields['offset'] = $offset;

        $parameters['start_time'] = '';
        $parameters['stop_time'] = '';
        $parameters['offset'] = '';

        return $this->request($url, $fields, $parameters);
    }
}
