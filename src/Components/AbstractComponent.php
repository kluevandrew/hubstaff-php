<?php


namespace Hubstaff\Components;

use Hubstaff\Curl;
use Hubstaff\Hubstaff;

class AbstractComponent
{
    protected $hubstaff;
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

    protected function request(array $fields, $parameters, $url, $type)
    {
        $fields['Auth-Token'] = $_SESSION['Auth-Token'];
        $fields['App-token'] = $_SESSION['App-Token'];
        
        $this->curl->send($fields, $parameters, $url, $type = 0);
    }
    
}