<?php
namespace App\Service;

class StaticCache
{
    public static array $data = [];

    public static function get(string $key, $default = null)
    {
        if (!static::has($key)) {
            if (is_null($default)) {
                throw new \OutOfBoundsException("Cache key {$key} does not exists");
            }

            return $default instanceof \Closure ? $default() : $default;
        }

        return static::$data[$key];
    }

    public static function set(string $key, $value)
    {
        static::$data[$key] = $value;
    }

    public static function has($key)
    {
        if (!empty(static::$data)) {
            return array_key_exists($key, static::$data);
        }
    }

    public static function forget($key)
    {
        if (static::has($key)) {
            unset(static::$data[$key]);
        }
    }

    public static function remember($key, $callback)
    {
        if (!static::has($key)) {
            static::set($key, $callback());
        }

        return static::$data[$key];
    }

}
