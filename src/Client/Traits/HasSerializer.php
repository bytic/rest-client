<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Normalizer\ResponseObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class HasSerializer
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasSerializer
{

    /**
     * @var SerializerInterface
     */
    protected $serializer = null;

    protected $encodersByFormat = [
        'json' => JsonEncoder::class
    ];

    /**
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        if ($this->serializer === null) {
            $this->setSerializer($this->discoverSerializer());
        }
        return $this->serializer;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    protected function discoverSerializer()
    {
        return new \Symfony\Component\Serializer\Serializer(
            $this->generateNormalizers(),
            $this->generateEncoders()
        );
    }

    /**
     * @return array
     */
    protected function generateNormalizers()
    {
        return [
            new ResponseObjectNormalizer()
        ];
    }

    /**
     * @return array
     */
    protected function generateEncoders()
    {
        $encoders = [];
        $formats = $this->getConfiguration()->getFormats();
        foreach ($formats as $format) {
            if (isset($this->encodersByFormat[$format])) {
                $encoders[] = new $this->encodersByFormat[$format]();
            }
        }
        return $encoders;
    }
}
