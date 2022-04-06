<?php

require_once('../config/Database.php');

abstract class Product
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
}