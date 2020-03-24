<?php

namespace ByTIC\RestClient\Endpoints\Traits;

/**
 * Trait DynamicMethod
 * @package ByTIC\RestClient\Endpoints\Traits
 */
trait DynamicMethod
{
    protected $method = 'GET';

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }
}