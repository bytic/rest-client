<?php

namespace ByTIC\RestClient\Request;

use ByTIC\RestClient\Client\AbstractClient;
use ByTIC\RestClient\Endpoints\EndpointInterface;
use ByTIC\RestClient\Utility\Traits\HasStreamFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class RequestBuilder
{
    use HasStreamFactory;

    /**
     * @var null|RequestInterface
     */
    protected $request = null;

    /**
     * @param EndpointInterface $endpoint
     * @return static
     */
    public static function fromEndpoint(AbstractClient $client, EndpointInterface $endpoint)
    {
        $self = new self();
        $self->setStreamFactory($client->getStreamFactory());

        [$bodyHeaders, $body] = $endpoint->getBody($client->getSerializer(), $client->getStreamFactory());

        $queryString = $endpoint->getQueryString();
        $uriGlue = false === strpos($endpoint->getUri(), '?') ? '?' : '&';
        $uri = $queryString !== '' ? $endpoint->getUri() . $uriGlue . $queryString : $endpoint->getUri();
        $self->request = $client->getRequestFactory()->createRequest($endpoint->getMethod(), $uri);

        $self->withBody($body);
        foreach ($endpoint->getHeaders($bodyHeaders) as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        return $self;
    }

    /**
     * @return RequestInterface|null
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * @param null $body
     */
    public function withBody($body = null)
    {
        if (empty($body)) {
            return;
        }
        if ($body instanceof StreamInterface) {
            $this->request = $this->request->withBody($body);
            return;
        }

        $streamFactory = $this->getStreamFactory();

        if (\is_resource($body)) {
            $this->request = $this->request->withBody($streamFactory->createStreamFromResource($body));
        } elseif (is_file($body)) {
            $this->request = $this->request->withBody($streamFactory->createStreamFromFile($body));
        } else {
            $this->request = $this->request->withBody($streamFactory->createStream($body));
        }
    }
}