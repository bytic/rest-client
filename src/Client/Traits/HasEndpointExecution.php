<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Client\AbstractClient;
use ByTIC\RestClient\Endpoints\EndpointInterface;
use ByTIC\RestClient\Endpoints\Traits\HasClient;
use ByTIC\RestClient\Request\RequestBuilder;

/**
 * Trait HasEndpointExecution
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasEndpointExecution
{
    /**
     * @param EndpointInterface|HasClient $endpoint
     * @param string $fetch
     * @return mixed
     */
    public function executeEndpoint(EndpointInterface $endpoint, $fetch = AbstractClient::FETCH_OBJECT)
    {
        $request = RequestBuilder::fromEndpoint($this, $endpoint)->getRequest();

        return $endpoint->parseResponse(
            $this->getHttpClient()->sendRequest($request),
            $this->getSerializer(),
            $fetch
        );
    }

}