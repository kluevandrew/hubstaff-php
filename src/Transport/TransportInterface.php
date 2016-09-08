<?php

namespace Hubstaff\Transport;

/**
 * Interface TransportInterface
 * @package Hubstaff\Transport
 */
interface TransportInterface
{
    /**
     * @param string $url
     * @param array $parameters
     * @param array $headers
     * @return string response
     */
    public function get($url, array $parameters = [], array $headers = []);

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return string response
     */
    public function post($url, array $data = [], array $headers = []);

}