<?php

namespace ByTIC\RestClient\Client\Traits;

use Psr\Http\Message\RequestFactoryInterface;

/**
 * Trait HasRequestFactory
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasRequestFactory
{

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory = null;

    /**
     * @return RequestFactoryInterface
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        if ($this->requestFactory === null) {
            $this->setRequestFactory($this->discoverRequestFactory());
        }
        return $this->requestFactory;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return RequestFactoryInterface
     */
    protected function discoverRequestFactory()
    {
        return \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
    }
}