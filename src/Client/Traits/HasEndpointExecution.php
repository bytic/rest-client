<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Client\AbstractClient;
use ByTIC\RestClient\Endpoints\EndpointInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Trait HasEndpointExecution
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasEndpointExecution
{
    /**
     * @param EndpointInterface $endpoint
     * @param string $fetch
     * @return mixed
     */
    public function executeEndpoint(EndpointInterface $endpoint, $fetch = AbstractClient::FETCH_OBJECT)
    {
        $request = $this->createRequestFromEndpoint($endpoint);

        return $endpoint->parseResponse(
            $this->getHttpClient()->sendRequest($request),
            $this->getSerializer(),
            $fetch
        );
    }

    /**
     * @param EndpointInterface $endpoint
     * @return RequestInterface
     */
    protected function createRequestFromEndpoint(EndpointInterface $endpoint)
    {
        [$bodyHeaders, $body] = $endpoint->getBody($this->getSerializer(), $this->getStreamFactory());

        $queryString = $endpoint->getQueryString();
        $uriGlue = false === strpos($endpoint->getUri(), '?') ? '?' : '&';
        $uri = $queryString !== '' ? $endpoint->getUri() . $uriGlue . $queryString : $endpoint->getUri();
        $request = $this->getRequestFactory()->createRequest($endpoint->getMethod(), $uri);

        if ($body) {
            if ($body instanceof StreamInterface) {
                $request = $request->withBody($body);
            } elseif (\is_resource($body)) {
                $request = $request->withBody($this->streamFactory->createStreamFromResource($body));
            } elseif (is_file($body)) {
                $request = $request->withBody($this->streamFactory->createStreamFromFile($body));
            } else {
                $request = $request->withBody($this->streamFactory->createStream($body));
            }
        }

        foreach ($endpoint->getHeaders($bodyHeaders) as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        return $request;
    }
}