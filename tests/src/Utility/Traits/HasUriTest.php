<?php

namespace ByTIC\RestClient\Tests\Utility\Traits;

use ByTIC\RestClient\Tests\Fixtures\Endpoints\SimpleEndpoint;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class HasUriTest extends TestCase
{
    public function test_getUri_from_const()
    {
        $object = new SimpleEndpoint();

        $uri = $object->getUri();
        self::assertInstanceOf(UriInterface::class, $uri);

        self::assertSame(SimpleEndpoint::BASE_URI, $uri->getPath());
    }
}
