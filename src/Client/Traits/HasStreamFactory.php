<?php

namespace ByTIC\RestClient\Client\Traits;

use Psr\Http\Message\StreamFactoryInterface;

/**
 * Trait HasStreamFactory
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasStreamFactory
{

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory = null;

    /**
     * @return StreamFactoryInterface
     */
    public function getStreamFactory(): StreamFactoryInterface
    {
        if ($this->streamFactory === null) {
            $this->setStreamFactory($this->discoverStreamFactory());
        }
        return $this->streamFactory;
    }

    /**
     * @param StreamFactoryInterface $streamFactory
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
    }

    /**
     * @return StreamFactoryInterface
     */
    protected function discoverStreamFactory()
    {
        return \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
    }
}