<?php

namespace ByTIC\RestClient\Tests\Headers;

use ByTIC\RestClient\Client\Configuration\Configuration;
use ByTIC\RestClient\Headers\HeadersBag;
use ByTIC\RestClient\Tests\AbstractTest;

/**
 * Class HasHeadersTest
 * @package ByTIC\RestClient\Tests\Clients
 */
class HasHeadersTest extends AbstractTest
{
    public function test_auto_init()
    {
        $config = new Configuration();
        static::assertInstanceOf(HeadersBag::class, $config->headers());
    }
}