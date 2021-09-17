<?php

namespace ByTIC\RestClient\Client\Configuration;

use ByTIC\RestClient\Headers\HasHeaders;
use ByTIC\RestClient\Utility\Traits\HasUri;

/**
 * Class Configuration
 * @package ByTIC\RestClient\Client\Configuration
 */
class Configuration
{
    use Traits\HasDefaultConfiguration;
    use Traits\HasFormats;
    use Traits\HasUserAgent;
    use HasHeaders;
    use HasUri;
}
