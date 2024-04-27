<?php

namespace App\Lib;

use Dotenv\Dotenv;
use \PDO;


$dotenv = Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

abstract class Database
{
    protected static ?PDO $connection = null;

    public function __construct()
    {
        $this->getConnection();
    }

    private function getConnection()
    {
        if (self::$connection === null) {
            self::$connection =  new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8", $_ENV['DB_USER'], $_ENV['DB_PASS'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$connection;
    }
}
