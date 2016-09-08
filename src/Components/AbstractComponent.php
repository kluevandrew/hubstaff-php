<?php


namespace Hubstaff\Components;

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
     * AbstractComponent constructor.
     * @param Hubstaff $hubstaff
     */
    public function __construct(Hubstaff $hubstaff)
    {
        $this->hubstaff = $hubstaff;
    }
}