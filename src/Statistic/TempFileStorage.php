<?php

namespace Hubstaff\Statistic;

use Hubstaff\Hubstaff;

class TempFileStorage implements StatisticStorageInterface
{
    /**
     * @var Hubstaff
     */
    protected $client;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var \DateTime[]
     */
    protected $requests = [];

    /**
     * @var \DateTime[]
     */
    protected $authRequests = [];

    /**
     * TempFileStorage constructor.
     * @param Hubstaff $client
     */
    public function __construct(Hubstaff $client)
    {
        $this->client = $client;
        $this->file = sys_get_temp_dir().'/hubstaff-'.$client->getAppToken().'.json';

        $this->load();
    }

    public function reload()
    {
        $this->requests = [];
        $this->authRequests = [];
        $this->load();
    }

    /**
     * @void
     */
    protected function load()
    {
        if (!file_exists($this->file)) {
            return;
        }

        $json = file_get_contents($this->file);
        $data = @json_decode($json, true);
        if (!$data) {
            return;
        }

        $now = new \DateTime();
        $hourAgo = $now->sub(new \DateInterval('PT1H'));

        foreach ($data as $requestType => $requests) {
            foreach ($requests as $requestDate) {
                $requestDate = new \DateTime($requestDate);
                if ($requestDate >= $hourAgo) {
                    $this->{$requestType}[] = $requestDate;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        file_put_contents($this->file, json_encode([
            'requests' => array_map(function (\DateTime $dateTime) { return $dateTime->format(DATE_ISO8601); }, $this->requests),
            'authRequests' => array_map(function (\DateTime $dateTime) { return $dateTime->format(DATE_ISO8601); }, $this->authRequests),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function incrementRequests()
    {
        $this->dropInvalidDates();

        $this->requests[] = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function incrementAuthRequest()
    {
        $this->dropInvalidDates();

        $this->requests[] = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastRequestDate()
    {
        $this->dropInvalidDates();

        $length = count($this->requests);

        return $length ? $this->requests[$length - 1] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastAuthRequestDate()
    {
        $this->dropInvalidDates();

        $length = count($this->authRequests);

        return $length ? $this->authRequests[$length - 1] : null;
    }

    protected function dropInvalidDates()
    {
        $now = new \DateTime();
        $hourAgo = $now->sub(new \DateInterval('PT1H'));

        foreach ($this->requests as $key => $requestDate) {
            if ($requestDate < $hourAgo) {
                unset($this->requests[$key]);
            }
        }

        foreach ($this->authRequests as $key => $requestDate) {
            if ($requestDate < $hourAgo) {
                unset($this->requests[$key]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLastHourRequestsCount()
    {
        $this->dropInvalidDates();

        return count($this->requests);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastHourAuthRequestsCount()
    {
        $this->dropInvalidDates();

        return count($this->authRequests);
    }
}