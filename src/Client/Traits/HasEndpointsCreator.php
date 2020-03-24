<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Endpoints\DynamicEndpoint;

/**
 * Trait HasEndpointsCreator
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasEndpointsCreator
{
    /**
     * @param $method
     * @param $uri
     * @param $body
     * @return DynamicEndpoint
     */
    protected function createBaseEndpoint($method, $uri, $body)
    {
        $endpoint = new DynamicEndpoint();
        $endpoint->setMethod($method);
        $endpoint->setUri($uri);
        return $endpoint;
    }
}