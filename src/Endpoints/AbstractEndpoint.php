<?php

namespace ByTIC\RestClient\Endpoints;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class AbstractEndpoint
 * @package ByTIC\RestClient\Endpoints
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    use Traits\CanParseResponse;

    /**
     * @inheritDoc
     */
    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    /**
     * @inheritDoc
     */
    public function getQueryString(): string
    {
        return '';
    }

    /**
     * @return array
     */
    protected function getExtraHeaders(): array
    {
        return [];
    }

    /**
     * Get the headers of an endpoint.
     * @inheritDoc
     */
    public function getHeaders(array $baseHeaders = []): array
    {
        return array_merge($this->getExtraHeaders(), $baseHeaders);
    }

    /**
     * @param string|null $contentType
     * @return bool|string
     */
    public function detectFormatFromContentType(string $contentType = null)
    {
        if (strpos($contentType, 'json')) {
            return 'json';
        }
        return false;
    }
}
