<?php

namespace Hubstaff\Components;

class Auth extends AbstractComponent
{
    public function auth($email, $password, $url)
    {
        $fields['email'] = $email;
        $fields['password'] = $password;

        $parameters['email'] = '';
        $parameters['password'] = '';

        return $this->request($url, $fields, $parameters, 1)['user']['auth_token'];
    }
}