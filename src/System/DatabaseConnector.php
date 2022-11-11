<?php

namespace Christiancannata\PhpApi\System;

class DatabaseConnector
{

    public $dbConnection;

    public $host;
    public $database;
    public $username;
    public $password;

    public function __construct()
    {

        $this->host = '127.0.0.1';
        $this->port = '3306';
        $this->database = 'dokicasa';
        $this->username = 'root';
        $this->password = 'root';

        try {
            $this->dbConnection = new \PDO(
                "mysql:host={$this->host};port={$this->port};charset=utf8mb4;dbname={$this->database}",
                $this->username,
                $this->password
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function prepare($query)
    {
        return $this->dbConnection->prepare($query);
    }


}