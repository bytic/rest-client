<?php

namespace ByTIC\RestClient\Endpoints\Traits;

use ByTIC\RestClient\Client\AbstractClient;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Trait CanParseResponse
 * @package ByTIC\RestClient\Endpoints\Traits
 */
trait CanParseResponse
{

    /**
     * @param ResponseInterface $response
     * @param SerializerInterface $serializer
     * @param string $fetchMode
     * @return ResponseInterface
     */
    public function parseResponse(
        ResponseInterface $response,
        SerializerInterface $serializer,
        string $fetchMode = AbstractClient::FETCH_OBJECT
    ) {
        if ($fetchMode === AbstractClient::FETCH_OBJECT) {
            $contentType = $response->hasHeader('Content-Type') ? current($response->getHeader('Content-Type')) : null;

            return $this->transformResponseBody(
                (string)$response->getBody(),
                $response->getStatusCode(),
                $serializer,
                $contentType
            );
        }

        if ($fetchMode === AbstractClient::FETCH_RESPONSE) {
            return $response;
        }

        throw new \InvalidArgumentException(sprintf('Fetch mode %s is not supported', $fetchMode));
    }

    /**
     * @param string $body
     * @param int $status
     * @param SerializerInterface $serializer
     * @param string|null $contentType
     * @return mixed
     */
    abstract protected function transformResponseBody(
        string $body,
        int $status,
        SerializerInterface $serializer,
        string $contentType = null
    );
}