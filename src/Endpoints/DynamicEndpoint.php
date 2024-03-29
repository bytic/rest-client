<?php

namespace ByTIC\RestClient\Endpoints;

use ByTIC\RestClient\Utility\Traits\HasUri;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BaseEndpoint
 * @package ByTIC\RestClient\Endpoints
 */
class DynamicEndpoint extends AbstractEndpoint
{
    use Traits\DynamicMethod;
    use HasUri;

    /**
     * @inheritDoc
     */
    protected function transformResponseBody(
        string $body,
        int $status,
        SerializerInterface $serializer,
        string $contentType = null
    ) {
        $format = $this->detectFormatFromContentType($contentType);

        return $serializer->deserialize($body, \stdClass::class, $format, [$contentType]);
    }
}