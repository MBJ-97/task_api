<?php

class Product
{
    protected $conn;
    //Product props
    protected int $id;
    protected ?string $sku;
    protected string $name;
    protected int $price;
    protected  string $type;

    public function __construct()
    {
        // Instantiate DB object + connect tot it
        $database = new Database();
        $db = $database->connect();

        $this->conn = $db;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($val)
    {
        $this->id = $val;
    }
    public function getSku()
    {
        return $this->sku;
    }
    public function setSku($val)
    {
        $this->sku = $val;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($val)
    {
        $this->name = $val;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($val)
    {
        $this->price = $val;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($val)
    {
        $this->type = $val;
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

    public function setProduct(): bool
    {
        //create the query
        $query ='
        INSERT INTO products
         SET
            sku = :sku,
            name = :name,
            price = :price,
            type = :type
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // cleanup data (ppl are submitting it)
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->type = htmlspecialchars(strip_tags($this->type));

        // bind data with named params
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);

        //execute our query
        if($stmt->execute()){
            return true;
        } else {
            // print error if smth goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }

    public function delete()
    {
        $query='
        DELETE FROM products
        WHERE
        id = :id
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        //bind data to query
        $stmt->bindParam(':id', $this->id);
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