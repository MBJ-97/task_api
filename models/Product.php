<?php

class Product
{
    private $conn;
    //Product props
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getProducts()
    {
        $query = 'SELECT * FROM products';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        return $stmt;
    }
}