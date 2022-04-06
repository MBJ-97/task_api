<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'task_db';
    private $username = 'root';
    private $password = 'password';
    private $conn;

    //db connection
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host='. $this->host . ';dbname=' .
                $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        return $this->conn;
    }

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

    public function findAll()
    {
        $query = 'SELECT * FROM products';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function delete($id)
    {
        $query='
        DELETE FROM products
        WHERE
        id = :id
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $id = htmlspecialchars(strip_tags($id));
        //bind data to query
        $stmt->bindParam(':id',$id);
        // execute the query
        if($stmt->execute()){
            return true;
        } else {
            // print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }

}