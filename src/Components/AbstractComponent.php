<?php


namespace Hubstaff\Components;

use Hubstaff\Curl;
use Hubstaff\Hubstaff;

/**
 * Class AbstractComponent
 * @package Hubstaff\Components
 */
class AbstractComponent
{
    /**
     * @var Hubstaff
     */
    protected $hubstaff;
    /**
     * @var Curl
     */
    protected $curl;

    /**
     * AbstractComponent constructor.
     * @param Hubstaff $hubstaff
     */
    public function __construct(Hubstaff $hubstaff)
    {
        $this->hubstaff = $hubstaff;
        $this->curl = new Curl();
    }

    /**
     * @param array $fields
     * @param $parameters
     * @param $url
     * @param int $type
     * @return mixed
     */
    protected function request($url, array $fields = [], array $parameters = [], $type = 0)
    {
        $fields['App-token'] = $this->hubstaff->getAppToken();
        $parameters['App-token'] = 'header';

        $authToken = $this->hubstaff->getAuthToken();
        if ($authToken) {
            $fields['Auth-Token'] = $authToken;
            $parameters['Auth-Token'] = 'header';
        }

        $response =  $this->curl->send($fields, $parameters, $url, $type);

        if (!$response) {
            return false;
        }

        return json_decode($response, true);
    }
}