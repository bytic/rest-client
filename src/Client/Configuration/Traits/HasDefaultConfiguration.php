<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

use ByTIC\RestClient\Client\Configuration\Configuration;

/**
 * Trait HasDefaultConfiguration
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasDefaultConfiguration
{
    protected static $defaultConfiguration;

    /**
     * Gets the default configuration instance
     *
     * @return Configuration
     */
    public static function getDefaultConfiguration()
    {
        if (self::$defaultConfiguration === null) {
            self::resetDefaultConfiguration();
        }

        return self::$defaultConfiguration;
    }

    /**
     * Sets the detault configuration instance
     *
     * @param Configuration $config An instance of the Configuration Object
     *
     * @return void
     */
    public static function setDefaultConfiguration(Configuration $config)
    {
        self::$defaultConfiguration = $config;
    }

    public static function resetDefaultConfiguration()
    {
        self::$defaultConfiguration = new Configuration();
    }
}
