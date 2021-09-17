<?php

namespace ByTIC\RestClient\Utility\Traits;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriInterface;

/**
 * Trait CanCreateUri
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasUri
{
    /**
     * @var UriInterface
     */

    protected $uri = null;

    /**
     * @return UriInterface
     */
    public function getUri()
    {
        if ($this->uri === null) {
            $this->initBaseUri();
        }
        return $this->uri;
    }
    /**
     * @param UriInterface|bool $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $this->normalizeUri($uri);
    }

    protected function initBaseUri()
    {
        $this->setUri('');
    }

    /**
     * @param $uri
     * @return UriInterface
     */
    protected function normalizeUri($uri): UriInterface
    {
        if ($uri instanceof UriInterface) {
            return $uri;
        }
        return Psr17FactoryDiscovery::findUriFactory()->createUri($uri);
    }

    /**
     * Sets the host
     *
     * @param string $host Host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->uri = $this->getUri()->withHost($host);
        return $this;
    }

    /**
     * Gets the host
     *
     * @return string Host
     */
    public function getHost()
    {
        return $this->getUri()->getHost();
    }

    /**
     * @return bool
     */
    public function hasHost()
    {
        return !empty($this->getUri()->getHost());
    }
}
