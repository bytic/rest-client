<?php

namespace ByTIC\RestClient\Client;

use ByTIC\RestClient\Client\Configuration\Configuration;
use Psr\Http\Client\ClientInterface;

/**
 * Class AbstractClient
 * @package ByTIC\RestClient\Client
 */
abstract class AbstractClient
{
    use Traits\HasBasicOperations;
    use Traits\HasConfiguration;
    use Traits\HasEndpointExecution;
    use Traits\HasEndpointsCreator;
    use Traits\HasHttpClient;
    use Traits\HasRequestFactory;
    use Traits\HasSerializer;
    use Traits\HasStreamFactory;

    public const FETCH_RESPONSE = 'response';
    public const FETCH_OBJECT = 'object';

    /**
     * AbstractClient constructor.
     * @param ClientInterface|null $httpClient
     * @param Configuration|null $configuration
     */
    public function __construct(ClientInterface $httpClient = null, Configuration $configuration = null)
    {
        $this->setConfiguration(
            $configuration ? $configuration : $this->discoverConfiguration()
        );

        $this->setHttpClient(
            $httpClient ? $httpClient : $this->discoverHttpClient()
        );
    }
}
