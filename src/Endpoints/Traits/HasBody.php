<?php

namespace ByTIC\RestClient\Endpoints\Traits;

use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;

trait HasBody
{
    protected $bodyData = null;

    protected $bodyFormat = 'json';

    /**
     * @inheritDoc
     */
    public function getBody(SerializerInterface $serializer, StreamFactoryInterface $streamFactory = null): array
    {
        return [
            $this->generateBodyHeaders(), // bodyHeaders
            $this->generateBodyStream($serializer, $streamFactory), // bodyHeaders
        ];
    }

    protected function generateBodyStream(SerializerInterface $serializer, StreamFactoryInterface $streamFactory = null)
    {
        $bodyData = $this->getBodyData();
        if ($bodyData == null) {
            return null;
        }
        if ($streamFactory && is_array($this->bodyData)) {
            return $streamFactory->createStream(http_build_query($bodyData));
        }
        return null;
    }

    protected function generateBodyHeaders(): array
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getBodyData()
    {
        return $this->bodyData;
    }

    public function setBodyData($bodyData)
    {
        $this->bodyData = $bodyData;
    }
}