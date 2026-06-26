<?php

namespace Src\Http;

use Src\Http\Request;
use Src\Http\Response;

class HandelRoute
{
    protected Request $request;
    protected Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function HandelRouteString(string $action, array $parm = [])
    {
        [$controller, $method] = explode('@', $action);

        $controller = 'App\\Controllers\\' . $controller;

        if (!class_exists($controller)) {
            response()->responseJSON('not found class' . $controller);
        }

        if (!method_exists($controller, $method)) {
            response()->responseJSON('not found method ' . $controller . ":" . $method);
        }

        call_user_func_array([new $controller, $method], $parm);
    }

    public static function HandelRouteArray(array $action, array $parm = [])
    {
        [$controller, $method] = $action;

        if (!class_exists($controller)) {
            response()->responseJSON('not found class' . $controller);
        }

        if (!method_exists($controller, $method)) {
            response()->responseJSON('not found method ' . $controller . ":" . $method);
        }

        call_user_func_array([new $controller, $method], $parm);
    }
}
