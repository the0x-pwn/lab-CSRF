<?php

namespace Src\Http;

class Request
{
    public function method(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function path(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $path = $path !== '/' ? rtrim($path, '/') : $path;
        return str_contains($path, '?') ? explode('?', $path)[0] : $path;
    }

    public function all(): array
    {
        return ($this->method() === 'post') ? $_POST : (($this->method() === 'get') ? $_GET : false);
    }

    public function exists(string $key): bool
    {
        return array_key_exists($key, $this->all());
    }

    public function input(string $key): mixed
    {
        return $this->exists($key) ? $this->all()[$key] : null;
    }
}
