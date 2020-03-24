<?php

namespace ByTIC\RestClient\Client\Configuration;

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
    use Traits\HasUserAgent;
}
