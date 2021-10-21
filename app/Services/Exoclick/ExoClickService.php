<?php

namespace App\Services\Exoclick;

use Exads\Client;

class ExoClickService
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var ExoClickCollection
     */
    protected $collection;

    /**
     * ExoClickService constructor.
     */
    public function __construct()
    {
        $this->client = $this->getClient();
        $this->collection = new ExoClickCollection($this->client);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCampaigns()
    {
        try {
            $campaigns = $this->client->campaigns->all();
        } catch (\Exception $e) {
            throw $e;
        }
        return $campaigns;
    }

    /**
     * @param array $data
     * @return bool|string
     * @throws \Exception
     */
    public function createCampaign(array $data)
    {
        try {
            $campaigns = $this->client->campaigns->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
        return $campaigns;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCategories()
    {
        try {
            $categories = $this->collection->categories();
        } catch (\Exception $e) {
            throw $e;
        }
        return $categories;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCountries()
    {
        try {
            $defaults = array(
                'limit' => 250,
                'offset' => 0,
            );
            $countries = $this->collection->countries($defaults);
        } catch (\Exception $e) {
            throw $e;
        }
        return $countries;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllData()
    {
        try {
            $allData = $this->collection->all();
        } catch (\Exception $e) {
            throw $e;
        }
        return $allData;
    }

    public function getAdvertiserAdTypes()
    {
        try {
            $types = $this->collection->advertiserAdTypes();
        } catch (\Exception $e) {
            throw $e;
        }
        return $types;
    }

    public function getDailyLimitTypes()
    {
        try {
            $limitTypes = $this->collection->dailyLimitTypes();
        } catch (\Exception $e) {
            throw $e;
        }
        return $limitTypes;
    }

    /**
     * @return Client
     * @throws \Exception
     */
    private function getClient()
    {
        try {
            $apiUrl = env('EXADS_API_URL');
            $apiToken = env('EXADS_API_TOKEN');
            $client = new Client($apiUrl);
            $sessionToken = $client->login->getToken($apiToken);
            $client->setApiToken($sessionToken);
        } catch (\Exception $e) {
            throw $e;
        }
        return $client;
    }
}
