<?php

namespace Src\Database;

use PDO;

class Connect
{
    protected ?PDO $db = null;
    public function __construct()
    {
        $dns = "mysql:host=" . env('DB_HOST') . ";dbname=" . env('DB_NAME') . ";charset=" . env('DB_CHARSET');
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->db = PDO::connect($dns, env('DB_USERNAME'), env('DB_PASSWORD'), $options);
    }

    public function GetConnect(): ?PDO
    {
        return $this->db;
    }
}
