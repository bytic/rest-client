<?php

namespace ByTIC\RestClient\Endpoints;

/**
 * Class AbstractEndpoint
 * @package ByTIC\RestClient\Endpoints
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    use Traits\CanParseResponse;
    use Traits\HasBody;

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
