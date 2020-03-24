<?php

namespace ByTIC\RestClient\Client\Configuration\Traits;

/**
 * Trait HasUserAgent
 * @package ByTIC\RestClient\Client\Configuration\Traits
 */
trait HasUserAgent
{

    /**
     * User agent of the HTTP request
     *
     * @var string
     */
    protected $userAgent = 'ByTIC Rest Client/1.0.0/php';

    /**
     * Sets the user agent of the api client
     *
     * @param string $userAgent the user agent of the api client
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setUserAgent($userAgent)
    {
        if (!is_string($userAgent)) {
            throw new \InvalidArgumentException('User-agent must be a string.');
        }

        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Gets the user agent of the api client
     *
     * @return string user agent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
}