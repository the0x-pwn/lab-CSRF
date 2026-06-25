<?php

namespace Src\Headers;

class Header
{
    public function set(string $key, string $value): void
    {
        header("$key: $value");
    }

    private function normalizeHeaderKey(string $key): string
    {
        return str_replace(' ', '-', ucwords(str_replace('-', ' ', strtolower($key))));
    }

    public function exists(string $key): bool
    {
        $key = $this->normalizeHeaderKey($key);
        return array_key_exists($key, getallheaders());
    }

    public function get(string $key): mixed
    {
        $key = $this->normalizeHeaderKey($key);
        return $this->exists($key) ?  getallheaders()[$key] : null;
    }

    public function all(): array
    {
        return getallheaders();
    }
}
