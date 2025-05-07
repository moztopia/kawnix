<?php

namespace Kawnix\Routing;

class Route
{
    protected static array $routes = [];

    public static function get(string $path, callable|array|string $action): void
    {
        self::addRoute('GET', $path, $action);
    }

    public static function post(string $path, callable|array|string $action): void
    {
        self::addRoute('POST', $path, $action);
    }

    public static function put(string $path, callable|array|string $action): void
    {
        self::addRoute('PUT', $path, $action);
    }

    public static function delete(string $path, callable|array|string $action): void
    {
        self::addRoute('DELETE', $path, $action);
    }

    protected static function addRoute(string $method, string $path, callable|array|string $action): void
    {
        self::$routes[$method][$path] = $action;
    }

    public static function resolve(string $method, string $path)
    {
        if (!isset(self::$routes[$method][$path])) {
            http_response_code(404);
            return "404 Not Found";
        }

        $action = self::$routes[$method][$path];

        if (is_callable($action)) {
            return call_user_func($action);
        } elseif (is_array($action)) {
            [$controller, $method] = $action;
            return call_user_func([new $controller, $method]);
        }

        return $action;
    }
}
