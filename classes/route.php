<?php


class Route
{
    private static array $routes;

    private static array $auths;

    public static function add(string $method,string $pattern,string $handler, bool $needAuth)
    {
        self::$routes[strtoupper($method)][$pattern] = ['handler' => strtolower($handler), 'needAuth' => $needAuth];
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}