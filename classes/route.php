<?php


class Route
{
    private static array $routes;

    public static function add($method,$pattern,$handler)
    {
        self::$routes[$method][$pattern] = $handler;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}