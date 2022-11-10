<?php

namespace ByTIC\RestClient\Endpoints\Traits;

use ByTIC\RestClient\Client\AbstractClient;

trait HasClient
{
    protected ?AbstractClient $client = null;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function execute($fetch = AbstractClient::FETCH_OBJECT)
    {
        return $this->getClient()->executeEndpoint($this, $fetch);
    }
}
