<?php

namespace ByTIC\RestClient\Tests\Client\Traits;

use ByTIC\RestClient\Client\BaseClient;
use ByTIC\RestClient\Client\Configuration\Configuration;
use ByTIC\RestClient\Tests\AbstractTest;

/**
 * Class HasBasicOperationsTest
 * @package ByTIC\RestClient\Tests\Client\Traits
 */
class HasBasicOperationsTest extends AbstractTest
{
    public function test_get()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setHost('jsonplaceholder.typicode.com')
            ->addFormatSupport('json');

        $client = new BaseClient(null, $config);
        $response = $client->get('/todos/1');
        self::assertInstanceOf(\stdClass::class, $response);
        self::assertSame('delectus aut autem', $response->title);
    }
}