<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

/**
 * Trait HasClientOptions
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasClientOptions
{
    protected $options = [];

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function addOption($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * @param array $formats
     * @return self
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }
}
