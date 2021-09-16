<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriInterface;

/**
 * Trait CanCreateUri
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait CanCreateBaseUri
{
    /**
     * @var UriInterface
     */
    protected $baseUri = null;

    /**
     * @return UriInterface
     */
    public function getBaseUri()
    {
        if ($this->baseUri === null) {
            $this->initBaseUri();
        }
        return $this->baseUri;
    }

    /**
     * @param UriInterface|bool $baseUri
     */
    public function setBaseUri($baseUri): void
    {
        $this->baseUri = $baseUri;
    }

    protected function initBaseUri()
    {
        if ($this->hasHost() === false) {
            $this->setBaseUri(false);
            return;
        }

        $this->setBaseUri(
            Psr17FactoryDiscovery::findUriFactory()->createUri(
                $this->generateUriString()
            )
        );
    }

    /**
     * @return string
     */
    protected function generateUriString()
    {
        return 'https://' . $this->getHost() . '';
    }
}