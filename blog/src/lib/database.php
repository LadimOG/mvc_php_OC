<?php

namespace App\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnect(): \PDO
    {
        if ($this->database === null) {
            $this->database =  new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
        }

        return $this->database;
    }
}
