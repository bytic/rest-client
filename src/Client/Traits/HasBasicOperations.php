<?php

namespace ByTIC\RestClient\Client\Traits;

/**
 * Trait HasBasicOperations
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasBasicOperations
{
    /**
     * @param string $url
     * @return mixed
     */
    public function get($url)
    {
        return $this->call("GET", $url, []);
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return mixed
     */
    public function post($url, $body = null)
    {
        return $this->call("POST", $url, $body);
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return mixed
     */
    public function delete($url, $body = null)
    {
        return $this->call("DELETE", $url, $body);
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return mixed
     */
    public function put($url, $body = null)
    {
        return $this->call("PUT", $url, $body);
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return mixed
     */
    public function patch($url, $body = null)
    {
        return $this->call("PATCH", $url, $body);
    }

    /**
     * @param $url
     * @return mixed
     */
    public function head($url)
    {
        return $this->call('HEAD', $url);
    }

    /**
     * @param $method
     * @param $uri
     * @param $body
     * @return mixed
     */
    protected function call($method, $uri, $body = null)
    {
        $endpoint = $this->createBaseEndpoint($method, $uri, $body);
        return $this->executeEndpoint($endpoint);
    }
}