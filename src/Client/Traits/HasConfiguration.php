<?php

namespace ByTIC\RestClient\Client\Traits;

use ByTIC\RestClient\Client\Configuration\Configuration;

/**
 * Trait HasConfiguration
 * @package ByTIC\RestClient\Client\Traits
 */
trait HasConfiguration
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @return Configuration
     */
    protected function discoverConfiguration()
    {
        return Configuration::getDefaultConfiguration();
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    protected function initConfiguration($configuration = null)
    {
        $this->setConfiguration(
            $configuration ?: $this->discoverConfiguration()
        );
    }
}