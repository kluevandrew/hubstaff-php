<?php
namespace Hubstaff\Components;

use Hubstaff\Curl;

class Projects extends AbstractComponent
{
    public function getprojects($status, $offset, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["offset"] = $offset;
        if ($status) {
            $fields["status"] = $status;
        }

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["offset"] = "";
        if ($status) {
            $parameters["status"] = "";
        }

        $curl = new Curl();

        return json_decode($curl->send($fields, $parameters, $url));
    }

    public function find_project($url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";

        $curl = new Curl();

        return json_decode($curl->send($fields, $parameters, $url));
    }

    public function find_project_members($offset, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["offset"] = $offset;

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["offset"] = "";

        $curl = new Curl();

        return json_decode($curl->send($fields, $parameters, $url));
    }

}