<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

/**
 * Trait HasFormats
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasFormats
{
    protected $formats = [];

    /**
     * @param mixed ...$formats
     * @return self
     */
    public function addFormatSupport(...$formats)
    {
        $this->formats = array_unique(array_merge($this->formats, $formats));
        return $this;
    }

    /**
     * @return array
     */
    public function getFormats(): array
    {
        return $this->formats;
    }

    /**
     * @param array $formats
     * @return self
     */
    public function setFormats(array $formats): HasFormats
    {
        $this->formats = $formats;
        return $this;
    }
}
