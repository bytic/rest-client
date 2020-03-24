<?php

namespace ByTIC\RestClient\Tests\Client\Configuration\Traits;

use ByTIC\RestClient\Client\Configuration\Configuration;
use ByTIC\RestClient\Tests\AbstractTest;

/**
 * Class HasFormatsTest
 * @package ByTIC\RestClient\Tests\Client\Configuration\Traits
 */
class HasFormatsTest extends AbstractTest
{
    public function test_getFormats_initialEmpty()
    {
        $configuration = new Configuration();
        $formats = $configuration->getFormats();

        self::assertIsArray($formats);
        self::assertCount(0, $formats);
    }

    public function test_addSupport()
    {
        $configuration = new Configuration();
        $configuration->addFormatSupport('json', 'xml');

        self::assertCount(2, $configuration->getFormats());

        $configuration->addFormatSupport('json', 'serialize');
        self::assertCount(3, $configuration->getFormats());
    }
}