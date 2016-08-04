<?php

namespace Hubstaff\Components;

use Hubstaff\Curl;

class Auth extends AbstractComponent
{
    public function auth($app_token, $email, $password, $url)
    {
        if ($_SESSION['Auth-Token']) {
            $auth_token = $_SESSION['Auth-Token'];
        } else {
            $fields["App-token"] = $app_token;
            $fields["email"] = $email;
            $fields["password"] = $password;

            $parameters["App-token"] = "header";
            $parameters["email"] = "";
            $parameters["password"] = "";
            $curl = new Curl();

            $auth_data = json_decode($curl->send($fields, $parameters, $url, 1));
            $auth_token = $auth_data->user->auth_token;

        }

        return $auth_token;

    }
}