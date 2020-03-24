<?php

namespace ByTIC\RestClient\Endpoints\Traits;

/**
 * Trait DynamicOperation
 * @package ByTIC\RestClient\Endpoints\Traits
 */
trait DynamicUri
{
    protected $uri = '';

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }
}