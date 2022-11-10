<?php

namespace ByTIC\RestClient\Headers;

/**
 * @inspiration https://github.com/voku/httpful/blob/master/src/Httpful/Headers.php
 * @inspiration https://github.com/symfony/symfony/blob/5.4/src/Symfony/Component/HttpFoundation/HeaderBag.php
 */
class HeadersBag implements \ArrayAccess, \Countable, \Iterator
{
    /** @var array Map of all registered headers, as original name => array of values */
    private $headers = [];

    /** @var array Map of lowercase header name => original name at registration */
    private $headerNames = [];

    /**
     * @var string[] case-sensitive keys
     *
     * @see offsetSet()
     * @see offsetUnset()
     * @see key()
     */
    protected $keys = [];

    public function __construct(array $headers = [])
    {
        foreach ($headers as $key => $values) {
            $this->set($key, $values);
        }
    }

    public function all()
    {
        return $this->headers;
    }

    /**
     * Replaces the current HTTP headers by a new set.
     */
    public function replace(array $headers = [])
    {
        $this->headers = [];
        $this->add($headers);
    }

    /**
     * Adds new headers the current HTTP headers set.
     */
    public function add(array $headers)
    {
        foreach ($headers as $key => $values) {
            $this->set($key, $values);
        }
    }

    /**
     * @param string $key
     * @param string|null $default
     * @return mixed|string|null
     */
    public function get(string $header, string $default = null)
    {
        $header = strtolower($header);

        if (!isset($this->headerNames[$header])) {
            return $default;
        }

        $header = $this->headerNames[$header];

        return $this->headers[$header];
    }

    /**
     * Sets a header by name.
     *
     * @param string|string[]|null $values The value or an array of values
     * @param bool $replace Whether to replace the actual value or not (true by default)
     */
    public function set(string $header, $value, bool $replace = true)
    {
        if (is_int($header)) {
            // Numeric array keys are converted to int by PHP but having a header name '123' is not forbidden by the spec
            // and also allowed in withHeader(). So we need to cast it to string again for the following assertion to pass.
            $header = (string) $header;
        }
        $this->assertHeader($header);
        $value = $this->normalizeHeaderValue($value);

        $normalized = strtolower($header);
        if (isset($this->headerNames[$normalized])) {
            $header = $this->headerNames[$normalized];
            $this->headers[$header] = array_merge($this->headers[$header], $value);
            return;
        }
        $this->headerNames[$normalized] = $header;
        $this->headers[$header] = $value;
    }

    /**
     * @see https://secure.php.net/manual/en/countable.count.php
     *
     * @return int the number of elements stored in the array
     */
    public function count(): int
    {
        return (int)\count($this->headers);
    }

    /**
     * @see https://secure.php.net/manual/en/iterator.current.php
     *
     * @return mixed data at the current position
     */
    public function current(): mixed
    {
        return \current($this->headers);
    }

    /**
     * @see https://secure.php.net/manual/en/iterator.key.php
     *
     * @return mixed case-sensitive key at current position
     */
    public function key(): mixed
    {
        $key = \key($this->headers);

        return $this->keys[$key] ?? $key;
    }

    /**
     * @see https://secure.php.net/manual/en/iterator.next.php
     *
     * @return void
     */
    public function next(): void
    {
        \next($this->headers);
    }

    /**
     * @see https://secure.php.net/manual/en/iterator.rewind.php
     *
     * @return void
     */
    public function rewind(): void
    {
        \reset($this->headers);
    }

    /**
     * @see https://secure.php.net/manual/en/iterator.valid.php
     *
     * @return bool if the current position is valid
     */
    public function valid(): bool
    {
        return \key($this->headers) !== null;
    }

    /**
     * Checks if the offset exists in data storage. The index is looked up with
     * the lowercase version of the provided offset.
     *
     * @see https://secure.php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param string $offset Offset to check
     *
     * @return bool if the offset exists
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->headerNames[strtolower($offset)]);
    }

    /**
     * Return the stored data at the provided offset. The offset is converted to
     * lowercase and the lookup is done on the data store directly.
     *
     * @see https://secure.php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param string $offset offset to lookup
     *
     * @return mixed the data stored at the offset
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param string $offset
     * @param string $value
     *
     * @return void
     * @throws ResponseHeaderException
     *
     */
    public function offsetSet($offset, $value): void
    {
        throw new ResponseHeaderException('Headers are read-only.');
    }

    /**
     * @param string $offset
     *
     * @return void
     * @throws ResponseHeaderException
     *
     */
    public function offsetUnset($offset): void
    {
        throw new ResponseHeaderException('Headers are read-only.');
    }


    protected function normalizeHeaderValue($value)
    {
        if (!is_array($value)) {
            return $this->trimHeaderValues([$value]);
        }

        if (count($value) === 0) {
            throw new \InvalidArgumentException('Header value can not be an empty array.');
        }

        return $this->trimHeaderValues($value);
    }

    /**
     * Trims whitespace from the header values.
     *
     * Spaces and tabs ought to be excluded by parsers when extracting the field value from a header field.
     *
     * header-field = field-name ":" OWS field-value OWS
     * OWS          = *( SP / HTAB )
     *
     * @param string[] $values Header values
     *
     * @return string[] Trimmed header values
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.2.4
     */
    protected function trimHeaderValues(array $values)
    {
        return array_map(function ($value) {
            if (!is_scalar($value) && null !== $value) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Header value must be scalar or null but %s provided.',
                        is_object($value) ? get_class($value) : gettype($value)
                    )
                );
            }

            return trim((string)$value, " \t");
        }, array_values($values));
    }

    protected function assertHeader($header)
    {
        if (!is_string($header)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Header name must be a string but %s provided.',
                    is_object($header) ? get_class($header) : gettype($header)
                )
            );
        }

        if ($header === '') {
            throw new \InvalidArgumentException('Header name can not be empty.');
        }
    }

}