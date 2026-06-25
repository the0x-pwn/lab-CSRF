<?php

namespace Src\Http;

use Src\Http\Request;
use Src\Http\Response;

class Route
{
    protected static array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get(string $route, array|callable|string $action)
    {
        static::$routes['get'][$route] = $action;
    }

    public static function post(string $route, array|callable|string $action)
    {
        static::$routes['post'][$route] = $action;
    }


    public function handel()
    {
        $method = $this->request->method();
        $path = $this->request->path();

        foreach (static::$routes[$method] ?? [] as $route => $action) {

            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route);

            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {

                array_shift($matches);

                return match (true) {
                    is_string($action) => HandelRoute::HandelRouteString($action, $matches),
                    is_callable($action) => $action(...$matches),
                    is_array($action) => HandelRoute::HandelRouteArray($action, $matches),
                };
            }
        }

        $this->response->responseJSON('Route not found', 404);
    }
}
