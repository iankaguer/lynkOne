<?php
namespace ORM;

use PDO;
use Config\DB;

class Admin{

    private $pdo;

    public function __construct()
    {
        $dbhost = DB::$hostname;
        $dbname = DB::$dbname;
        $charset = DB::$charset;
        $username = DB::$username;
        $password = DB::$password;
        $dbport = DB::$port;
        
        if ($this->pdo == null) {
            $this->pdo = new PDO(
                "mysql:dbname={$dbname};host={$dbhost};port=$dbport;charset=$charset",
                $username, $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
    
}