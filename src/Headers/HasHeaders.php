<?php

namespace ByTIC\RestClient\Headers;

/**
 *
 */
trait HasHeaders
{
    protected $headers = null;

    public function headers(): ?HeadersBag
    {
        if ($this->headers === null) {
            $this->headers = new HeadersBag();
        }
        return $this->headers;
    }
}