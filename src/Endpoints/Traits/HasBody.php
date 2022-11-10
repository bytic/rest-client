<?php

namespace ByTIC\RestClient\Endpoints\Traits;

use Symfony\Component\Serializer\SerializerInterface;

trait HasBody
{
    protected $bodyData = null;

    protected $bodyFormat = 'json';

    /**
     * @inheritDoc
     */
    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        $bodyData = $this->getBodyData();
        return [
            $this->generateBodyHeaders(), // bodyHeaders
            $bodyData == null ? $bodyData : $serializer->serialize($this->getBodyData(), 'json', []) // body
        ];
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
}