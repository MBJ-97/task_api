<?php


require_once('../models/Product.php');


class Disc extends Product
{
    protected int $size;

    public function getSize()
    {
        return $this->size;
    }
    public function setSize($val)
    {
        $this->size = $val;
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
            size = :size
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // cleanup data (ppl are submitting it)
        $this->sku = htmlspecialchars(strip_tags($data->sku));
        $this->name = htmlspecialchars(strip_tags($data->name));
        $this->price = htmlspecialchars(strip_tags($data->price));
        $this->type = htmlspecialchars(strip_tags($data->type));
        $this->size = htmlspecialchars(strip_tags($data->size));


        // bind data with named params
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':size', $this->size);


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