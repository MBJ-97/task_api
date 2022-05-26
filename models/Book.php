<?php


require_once('../models/Product.php');


class Book extends Product
{
    protected float $weight;

    public function getWeight()
    {
        return $this->weight;
    }
    public function setWeight($val)
    {
        $this->weight = $val;
    }

    public function create($data): bool
    {
        //create the query
        $query ='
        INSERT INTO products
         SET
            sku = :sku,
            name = :name,
            price = :price,
            type = :type,
            weight = :weight
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // cleanup data (ppl are submitting it)
        $this->sku = htmlspecialchars(strip_tags($data->sku));
        $this->name = htmlspecialchars(strip_tags($data->name));
        $this->price = htmlspecialchars(strip_tags($data->price));
        $this->type = htmlspecialchars(strip_tags($data->type));
        $this->weight = htmlspecialchars(strip_tags($data->weight));


        // bind data with named params
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':weight', $this->weight);


        //execute our query
        if($stmt->execute()){
            return true;
        } else {
            // print error if smth goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
    }
}