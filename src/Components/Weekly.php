<?php
namespace Hubstaff\Components;

class Weekly extends AbstractComponent
{
    public function weekly_team($options, $url)
    {
        $fields = [];
        $parameters = [];
        if (isset($options['date'])) {
            $fields['date'] = $options['date'];
            $parameters["date"] = "";
        }
        if (isset($options['organizations'])) {
            $fields['organizations'] = $options['organizations'];
            $parameters["organizations"] = "";
        }
        if (isset($options['projects'])) {
            $fields['projects'] = $options['projects'];
            $parameters["projects"] = "";
        }
        if (isset($options['users'])) {
            $fields['users'] = $options['users'];
            $parameters["users"] = "";
        }

        return json_decode($this->request($fields, $parameters, $url));
    }

    public function weekly_my($options, $url)
    {
        $fields = [];
        $parameters = [];

        if (isset($options['date'])) {
            $fields['date'] = $options['date'];
            $parameters["date"] = "";
        }
        if (isset($options['organizations'])) {
            $fields['organizations'] = $options['organizations'];
            $parameters["organizations"] = "";
        }
        if (isset($options['projects'])) {
            $fields['projects'] = $options['projects'];
            $parameters["projects"] = "";
        }
        if (isset($options['users'])) {
            $fields['users'] = $options['users'];
            $parameters["users"] = "";
        }

        return json_decode($this->request($fields, $parameters, $url));
    }

}
