<?php

namespace ByTIC\RestClient\Tests\Client\Traits;

use ByTIC\RestClient\Client\BaseClient;
use ByTIC\RestClient\Client\Configuration\Configuration;
use ByTIC\RestClient\Tests\AbstractTest;
use Symfony\Component\Serializer\Serializer;

/**
 * Class HasSerializerTest
 * @package ByTIC\RestClient\Tests\Client\Traits
 */
class HasSerializerTest extends AbstractTest
{
    public function test_generateEncoders()
    {
        $config = Configuration::getDefaultConfiguration()
            ->addFormatSupport('json');

        $client = new BaseClient(null, $config);
        $serializer = $client->getSerializer();

        self::assertInstanceOf(Serializer::class, $serializer);
        self::assertTrue($serializer->supportsDecoding('json'));
    }
}