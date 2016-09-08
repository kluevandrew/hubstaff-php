<?php
namespace Hubstaff\Components;

class Weekly extends AbstractComponent
{
    public function weekly_team($options, $url)
    {
        $parameters = [];
        if (isset($options['date'])) {
            $parameters['date'] = $options['date'];
        }
        if (isset($options['organizations'])) {
            $parameters['organizations'] = $options['organizations'];
        }
        if (isset($options['projects'])) {
            $parameters['projects'] = $options['projects'];
        }
        if (isset($options['users'])) {
            $parameters['users'] = $options['users'];
        }

        return $this->hubstaff->get($url, $parameters);
    }

    public function weekly_my($options, $url)
    {
        $parameters = [];

        if (isset($options['date'])) {
            $parameters['date'] = $options['date'];
        }
        if (isset($options['organizations'])) {
            $parameters['organizations'] = $options['organizations'];
        }
        if (isset($options['projects'])) {
            $parameters['projects'] = $options['projects'];
        }
        if (isset($options['users'])) {
            $parameters['users'] = $options['users'];
        }

        return $this->hubstaff->get($url, $parameters);
    }

}
