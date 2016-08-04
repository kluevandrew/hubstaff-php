<?php

namespace Hubstaff;

class Curl
{
    public function send($fields, $parameters, $url, $type = 0)
    {
        $post_string = '';
        $header_string = '';
        foreach ($fields as $key => $value) {
            if ($parameters[$key] == "header") {
                $header_string[] .= $key . ': ' . $value;
            } else {
                $post_string .= $key . '=' . $value . '&';
            }
        }
        $post_string = rtrim($post_string, "&");
        $curl = curl_init();
        if (!$type) {
            curl_setopt($curl, CURLOPT_URL, $url . '?' . $post_string);
        } else {
            curl_setopt($curl, CURLOPT_URL, $url);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if ($type) {
            curl_setopt($curl, CURLOPT_POST, count($fields));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
        }
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }
}