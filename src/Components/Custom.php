<?php
namespace Hubstaff\Components;

use Hubstaff\Curl;

class Custom extends AbstractComponent
{
    public function custom_report($start_date, $end_date, $options, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["start_date"] = $start_date;
        $fields["end_date"] = $end_date;

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
        if (isset($options['show_tasks'])) {
            $fields['show_tasks'] = $options['show_tasks'];
            $parameters["show_tasks"] = "";
        }
        if (isset($options['show_notes'])) {
            $fields['show_notes'] = $options['show_notes'];
            $parameters["show_notes"] = "";
        }
        if (isset($options['show_activity'])) {
            $fields['show_activity'] = $options['show_activity'];
            $parameters["show_activity"] = "";
        }
        if (isset($options['include_archived'])) {
            $fields['include_archived'] = $options['include_archived'];
            $parameters["include_archived"] = "";
        }


        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["start_date"] = "";
        $parameters["end_date"] = "";

        $curl = new Curl();

        $custom_data = json_decode($curl->send($fields, $parameters, $url));

        return $custom_data;
    }
    
}
