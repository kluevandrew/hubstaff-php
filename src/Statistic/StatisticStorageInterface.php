<?php

namespace Hubstaff\Statistic;

interface StatisticStorageInterface
{
    /**
     * @return \DateTime|null
     */
    public function getLastRequestDate();

    /**
     * @return \DateTime|null
     */
    public function getLastAuthRequestDate();

    /**
     * @return integer
     */
    public function getLastHourRequestsCount();

    /**
     * @return integer
     */
    public function getLastHourAuthRequestsCount();

    /**
     * @return void
     */
    public function incrementRequests();

    /**
     * @return void
     */
    public function incrementAuthRequest();

    /**
     * @return void
     */
    public function save();

    /**
     * @return mixed
     */
    public function reload();
}