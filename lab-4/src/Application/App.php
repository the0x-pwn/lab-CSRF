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
        $this->CSRF();
        $this->handel = new HandelRoute($this->request, $this->response);
    }

    public function run()
    {
        return $this->route->handel();
    }


    private function CSRF()
    {
        $stmt = db()->prepare('SELECT * FROM tokens ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        $fetch = $stmt->fetch(\PDO::FETCH_ASSOC);
        ['id' => $id, 'csrf' => $token] = $fetch;

        if (!session()->exists('token')) {
            session()->set('token', ['id' => $id, 'csrf' => $token]);
        }

        if ($this->request->method() === 'post') {
            $stmt = db()->prepare('SELECT csrf FROM tokens WHERE csrf = ? LIMIT 1');
            $stmt->execute([
                request()->input('csrf'),
            ]);

            $exists = $stmt->fetch();

            if (!$exists) {
                response()->responseJSON('Invalid CSRF Token', 401);
            }

            $deleteToken = db()->prepare('DELETE FROM tokens WHERE id = :id');
            $deleteToken->execute([
                session()->get('token')['id'],
            ]);

            $addToken = db()->prepare("INSERT INTO tokens (csrf) VALUES (:token)");
            $addToken->execute([':token' => bin2hex(random_bytes(60))]);
            session()->remove('token');
        }
    }
}
