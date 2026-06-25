<?php

namespace Src\Support;

class SessionFlash
{
    protected static string $meg = 'meg';

    public function set(array $data): void
    {
        foreach ($data as $key => $value) {
            $_SESSION[static::$meg][$key] = $value;
        }
    }


    public function exists(string $key): bool
    {
        return isset($_SESSION[static::$meg])
            && is_array($_SESSION[static::$meg])
            && array_key_exists($key, $_SESSION[static::$meg]);
    }


    public function get(string $key): mixed
    {
        if (!$this->exists($key)) {
            return null;
        }
        $value = $_SESSION[static::$meg][$key];
        return $value;
    }

    public function clear(): void
    {
        unset($_SESSION[static::$meg]);
    }
}
