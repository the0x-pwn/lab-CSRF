<?php

namespace Src\Support;

class Session
{
    protected static string $info = 'info';

    public function set(string $key, string|array $value): void
    {
        $_SESSION[static::$info][$key] = $value;
    }

    public function exists(string $key): bool
    {
        return isset($_SESSION[static::$info][$key]);
    }

    public function get(string $key): mixed
    {
        return $this->exists($key) ? $_SESSION[static::$info][$key] : null;
    }

    public function remove(string $key)
    {
        if ($this->exists($key)) {
            unset($_SESSION[static::$info][$key]);
        }
        return null;
    }


    public function all(): array
    {
        return $_SESSION[static::$info];
    }


    public function destroy()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            session_destroy();
            session_unset();
        }
    }
}
