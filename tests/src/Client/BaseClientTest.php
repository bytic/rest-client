<?php

namespace ByTIC\RestClient\Tests\Client;

use ByTIC\RestClient\Client\BaseClient;
use ByTIC\RestClient\Client\Configuration\Configuration;
use ByTIC\RestClient\Tests\AbstractTest;
use Psr\Http\Client\ClientInterface;

/**
 * Class BaseClientTest
 * @package ByTIC\RestClient\Tests\Clients
 */
class BaseClientTest extends AbstractTest
{
    public function test_construct_emptyParams()
    {
        $client = new BaseClient();

        static::assertInstanceOf(ClientInterface::class, $client->getHttpClient());
        static::assertInstanceOf(Configuration::class, $client->getConfiguration());
    }
}