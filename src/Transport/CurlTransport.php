<?php

namespace Hubstaff\Transport;

class CurlTransport implements TransportInterface
{
    const DEFAULTS = [];

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * CurlTransport constructor.
     * @param string $baseUrl
     * @param array $options
     */
    public function __construct($baseUrl, array $options = [])
    {
        $this->baseUrl = $baseUrl;
        $this->options = array_merge(self::DEFAULTS, $options);
    }

    public function get($url, array $parameters = [], array $headers = [])
    {
        $curl = curl_init();

        if ($headers) {
            $headersStrings = [];
            foreach ($headers as $key => $value) {
                $headersStrings[] = $key . ': ' . $value;
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headersStrings);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl.$url . '?' .  http_build_query($parameters));
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function post($url, array $parameters = [], array $headers = [])
    {
        $curl = curl_init();

        if ($headers) {
            $headersStrings = [];
            foreach ($headers as $key => $value) {
                $headersStrings[] = $key . ': ' . $value;
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headersStrings);
        }

        if ($parameters) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }

        curl_setopt($curl, CURLOPT_URL, $this->baseUrl.$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

}