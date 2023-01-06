<?php

namespace App\lib;

class Database
{

    /*private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct()
    {
        $this->host = $_ENV['HOST'];
        $this->db = $_ENV['DB'];
        $this->user = $_ENV['USER'];
        $this->password = $_ENV['PASSWORD'];
        $this->charset = $_ENV['CHARSET'];
    }

    function connect():\PDO{

        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new \PDO($connection, $this->user, $this->password, $options);

        }catch(\PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
        return $pdo;
    }*/

}