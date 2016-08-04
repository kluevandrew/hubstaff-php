<?php
namespace Hubstaff\Components;

use Hubstaff\Curl;

class Users extends AbstractComponent
{
    public function getusers($organization_memberships, $project_memberships, $offset, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["organization_memberships"] = (int)$organization_memberships;
        $fields["project_memberships"] = (int)$project_memberships;
        $fields["offset"] = $offset;

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["organization_memberships"] = "";
        $parameters["project_memberships"] = "";
        $parameters["offset"] = "";

        $curl = new Curl();

        $users_data = json_decode($curl->send($fields, $parameters, $url));

        return $users_data;
    }

    public function find_user($url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";

        $curl = new Curl();

        $user_data = json_decode($curl->send($fields, $parameters, $url));

        return $user_data;
    }

    public function find_user_orgs($offset, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["offset"] = $offset;

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["offset"] = "header";

        $curl = new Curl();

        $org_data = json_decode($curl->send($fields, $parameters, $url));

        return $org_data;
    }

    public function find_user_projects($offset, $url)
    {
        $fields["Auth-Token"] = $_SESSION['Auth-Token'];
        $fields["App-token"] = $_SESSION['App-Token'];
        $fields["offset"] = $offset;

        $parameters["Auth-Token"] = "header";
        $parameters["App-token"] = "header";
        $parameters["offset"] = "header";

        $curl = new Curl();

        $org_data = json_decode($curl->send($fields, $parameters, $url));

        return $org_data;
    }
}

?>