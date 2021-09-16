<?php

namespace ByTIC\RestClient\Tests\Headers;

use ByTIC\RestClient\Headers\HeadersBag;
use ByTIC\RestClient\Tests\AbstractTest;

class HeadersBagTest extends AbstractTest
{
    public function test_set()
    {
        $bag = new HeadersBag();

        $bag->set('Authorization', 'Bearer 080042cad6356ad5dc0a720c18b53b8e53d4c274');
        static::assertEquals(['Authorization' => ['Bearer 080042cad6356ad5dc0a720c18b53b8e53d4c274']], $bag->all());
    }
}