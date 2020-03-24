<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

/**
 * Trait HasHost
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasHost
{

    /**
     * The host
     *
     * @var string
     */
    protected $host = null;

    /**
     * Sets the host
     *
     * @param string $host Host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Gets the host
     *
     * @return string Host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return bool
     */
    public function hasHost()
    {
        return !empty($this->host);
    }
}