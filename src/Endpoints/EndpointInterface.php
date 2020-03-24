<?php

namespace ByTIC\RestClient\Endpoints;

use ByTIC\RestClient\Client\AbstractClient;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Interface EndpointInterface
 * @package ByTIC\RestClient\Endpoints
 */
interface EndpointInterface
{

    /**
     * Get body for an endpoint.
     *
     * Return value consist of an array where the first item will be a list of headers to add on the request (like the Content Type)
     * And the second value consist of the body object.
     * @param SerializerInterface $serializer
     * @param null $streamFactory
     * @return array
     */
    public function getBody(SerializerInterface $serializer, $streamFactory = null): array;

    /**
     * Get the query string of an endpoint without the starting ? (like foo=foo&bar=bar).
     */
    public function getQueryString(): string;

    /**
     * Get the URI of an endpoint (like /foo-uri).
     */
    public function getUri(): string;

    /**
     * Get the HTTP method of an endpoint (like GET, POST, ...).
     */
    public function getMethod(): string;

    /**
     * Get the headers of an endpoint.
     * @param array $baseHeaders
     * @return array
     */
    public function getHeaders(array $baseHeaders = []): array;

    /**
     * Parse and transform a PSR7 Response into a different object.
     *
     * Implementations may vary depending the status code of the response and the fetch mode used.
     * @param ResponseInterface $response
     * @param SerializerInterface $serializer
     * @param string $fetchMode
     */
    public function parseResponse(
        ResponseInterface $response,
        SerializerInterface $serializer,
        string $fetchMode = AbstractClient::FETCH_OBJECT
    );
}