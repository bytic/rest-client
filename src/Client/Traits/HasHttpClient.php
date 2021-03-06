<?php

namespace ByTIC\RestClient\Client\Traits;

use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriInterface;

/**
 * Trait HasHttpClient
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasHttpClient
{

    /**
     * @var \Psr\Http\Client\ClientInterface;
     */
    protected $httpClient;

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $this->decorateHttpClient($httpClient);
    }

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    protected function discoverHttpClient()
    {
        return \Http\Discovery\Psr18ClientDiscovery::find();
    }

    /**
     * @param ClientInterface $httpClient
     * @return PluginClient
     */
    protected function decorateHttpClient(ClientInterface $httpClient)
    {
        $uri = $this->getConfiguration()->getBaseUri();
        $plugins = [new ErrorPlugin()];
        if ($uri instanceof UriInterface) {
            if ($uri->getHost()) {
                $plugins[] = new AddHostPlugin($uri);
            }
        }
        return new PluginClient($httpClient, $plugins);
    }
}
