<?php

namespace ByTIC\RestClient\Client\Configuration;

use ByTIC\RestClient\Headers\HasHeaders;

/**
 * Class Configuration
 * @package ByTIC\RestClient\Client\Configuration
 */
class Configuration
{
    use Traits\CanCreateBaseUri;
    use Traits\HasDefaultConfiguration;
    use Traits\HasFormats;
    use Traits\HasHost;
    use HasHeaders;
    use Traits\HasUserAgent;
}
