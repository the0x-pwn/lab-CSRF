<?php

namespace Src\Application;

session_start();

use Dotenv\Dotenv;
use Src\Http\HandelRoute;
use Src\Http\Request;
use Src\Http\Response;
use Src\Http\Route;

class App
{
    protected Request $request;
    protected Response $response;
    protected Route $route;
    protected HandelRoute $handel;
    public function __construct()
    {
        Dotenv::createImmutable(base_path())->load();
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
        $this->handel = new HandelRoute($this->request, $this->response);
    }

    public function run()
    {
        return $this->route->handel();
    }
}
