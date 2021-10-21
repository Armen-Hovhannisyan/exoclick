<?php

namespace App\Services\Exoclick;

use Exads\Api\Collection;
use Exads\Client;

class ExoClickCollection  extends Collection
{


    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function countries(array $params = array())
    {
        return $this->get($this->getPath('countries'), $params);
    }

    /**
     * @param array $params
     * @return array|string
     */
    public function advertiserAdTypes(array $params = array())
    {
        return $this->get($this->getPath('advertiserAdTypes'), $params);
    }

    /**
     * @param array $params
     * @return array|string
     */
    public function dailyLimitTypes(array $params = array())
    {
        return $this->get($this->getPath('dailyLimitTypes'), $params);
    }


    /**
     * @param string $endPoint
     *
     * @return string
     */
    protected function getPath($endPoint = null)
    {
        $pathMapping = array(
            'all' => '%s',
            'browsers' => '%s/browsers',
            'carriers' => '%s/carriers',
            'categories' => '%s/categories',
            'devices' => '%s/devices',
            'languages' => '%s/languages',
            'os' => '%s/operating-systems',
            'countries' => '%s/countries',
            'advertiserAdTypes' => '%s/advertiser-ad-types',
            'dailyLimitTypes' => '%s/daily-limit-types',
        );
        if (!isset($pathMapping[$endPoint])) {
            throw new \InvalidArgumentException('Non existing path');
        }
        $path = $pathMapping[$endPoint];

        return sprintf($path, $this->apiGroup);
    }

}
