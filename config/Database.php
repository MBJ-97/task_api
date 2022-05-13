<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'task_db'; // id18758011_task_db
    private $username = 'root'; // id18758011_root
    private $password = 'password'; // IYf+6BfQ]3B{[2SE
    private $conn;

    //db connection
    public function connect(): object
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host='. $this->host . ';dbname=' .
            $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }

}