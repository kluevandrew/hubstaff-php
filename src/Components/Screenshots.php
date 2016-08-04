<?php
namespace Hubstaff\Components;

use Hubstaff\Curl;

class Screenshots extends AbstractComponent
{
    public function getscreenshots($starttime, $endtime, $offset, $options, $url)
    {
        $fields["start_time"] = $starttime;
        $fields["stop_time"] = $endtime;

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

        $fields["offset"] = $offset;


        $parameters["start_time"] = "";
        $parameters["stop_time"] = "";
        $parameters["offset"] = "";

        return json_decode($this->request($fields, $parameters, $url));
    }

}