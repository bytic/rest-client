<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Endpoints\AbstractEndpoint;
use ByTIC\RestClient\Endpoints\DynamicEndpoint;

/**
 * Trait HasEndpointsCreator
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasEndpointsCreator
{
    /**
     * @var AbstractEndpoint[]
     */
    protected array $endpoints = [];

    public function getEndpoint(string $name): AbstractEndpoint
    {
        if (!isset($this->endpoints[$name])) {
            $this->endpoints[$name] = $this->createEndpoint($name);
        }
        return $this->endpoints[$name];
    }

    protected function createEndpoint($class)
    {
        $endpoint = new $class();
        if (method_exists($endpoint, 'setClient')) {
            $endpoint->setClient($this);
        }

        return $endpoint;
    }

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