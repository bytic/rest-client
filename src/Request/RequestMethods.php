<?php

namespace ByTIC\RestClient\Request;

class RequestMethods
{
    public const HEAD = 'HEAD';
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    public const PATCH = 'PATCH';
    public const OPTIONS = 'OPTIONS';
    public const TRACE = 'TRACE';

    /**
     * @return array of HTTP method strings
     */
    public static function safeMethods(): array
    {
        return array(self::HEAD, self::GET, self::OPTIONS, self::TRACE);
    }

    /**
     * @param string HTTP method
     * @return bool
     */
    public static function isSafeMethod($method): bool
    {
        return in_array($method, self::safeMethods());
    }

    /**
     * @param string HTTP method
     * @return bool
     */
    public static function isUnsafeMethod($method): bool
    {
        return !in_array($method, self::safeMethods());
    }

    /**
     * @return array list of (always) idempotent HTTP methods
     */
    public static function idempotentMethods(): array
    {
        // Though it is possible to be idempotent, POST
        // is not guarunteed to be, and more often than
        // not, it is not.
        return [self::HEAD, self::GET, self::PUT, self::DELETE, self::OPTIONS, self::TRACE, self::PATCH];
    }

    /**
     * @param string HTTP method
     * @return bool
     */
    public static function isIdempotent($method): bool
    {
        return in_array($method, self::idempotentMethods());
    }

    /**
     * @param string HTTP method
     * @return bool
     */
    public static function isNotIdempotent($method): bool
    {
        return !in_array($method, self::idempotentMethods());
    }
}