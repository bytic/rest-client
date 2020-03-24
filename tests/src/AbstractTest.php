<?php

namespace ByTIC\RestClient\Tests;

use ByTIC\RestClient\Client\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    protected function tearDown()
    {
        parent::tearDown();
        Configuration::resetDefaultConfiguration();
    }
}
