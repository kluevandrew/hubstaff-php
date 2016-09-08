<?php
namespace Hubstaff\Components;

class Custom extends AbstractComponent
{
    public function customReport($start_date, $end_date, $options, $url)
    {
        $parameters = [];

        $parameters['start_date'] = $start_date;
        $parameters['end_date'] = $end_date;

        if (isset($options['organizations'])) {
            $parameters['organizations'] = $options['organizations'];
        }
        if (isset($options['projects'])) {
            $parameters['projects'] = $options['projects'];
        }
        if (isset($options['users'])) {
            $parameters['users'] = $options['users'];
        }
        if (isset($options['show_tasks'])) {
            $parameters['show_tasks'] = $options['show_tasks'];
        }
        if (isset($options['show_notes'])) {
            $parameters['show_notes'] = $options['show_notes'];
        }
        if (isset($options['show_activity'])) {
            $parameters['show_activity'] = $options['show_activity'];
        }
        if (isset($options['include_archived'])) {
            $parameters['include_archived'] = $options['include_archived'];
        }

        return $this->hubstaff->get($url, $parameters);
    }

}
