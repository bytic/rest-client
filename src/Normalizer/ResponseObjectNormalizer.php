<?php

namespace ByTIC\RestClient\Normalizer;

use stdClass;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ResponseObjectNormalizer
 * @package ByTIC\RestClient\Normalizer
 */
class ResponseObjectNormalizer
    implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return (object)$data;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $format === 'json' && $type == stdClass::class;
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $object;
        // TODO: Implement normalize() method.
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        $data;
        // TODO: Implement supportsNormalization() method.
    }
}
