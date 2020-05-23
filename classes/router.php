<?php


class Router
{
    private static $routes = [];

    public static function add($method,$pattern,$handler)
    {
        self::$routes[$method][$pattern] = $handler;
    }

//    public static function get()
//    {
//        return self::$routes;
//    }

    private static function validate()
    {
        if (isset($_GET)) {
            $method = 'GET';
            $key = key($_GET);
        } elseif (isset($_POST)) {$method = 'POST'; $key = key($_POST);}
        if (isset($method)) {
            foreach (self::$routes[$method] as $pattern => $controller) {
                if (preg_match('/'.$pattern.'/',$key)) {
                    return array('query' => $key,'controller' => $controller);
                }
            }
        }
        return false;
    }

    public static function getCotroller()
    {
        $query = self::validate();
//        TODO: make api error and return to client
        if ($query === false) return false;

    }
}