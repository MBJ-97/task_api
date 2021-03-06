<?php

require_once('../models/Product.php');

class Furniture extends Product
{
    protected int $height;
    protected int $width;
    protected int $length;

    public function getHeight()
    {
        return $this->height;
    }
    public function setHeight($val)
    {
        $this->height = $val;
    }

    public function getWidth()
    {
        return $this->width;
    }
    public function setWidth($val)
    {
        $this->width = $val;
    }

    public function getLength()
    {
        return $this->length;
    }
    public function setLength($val)
    {
        $this->length = $val;
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
            height = :height,
            width = :width,
            length = :length
        ';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // cleanup data (ppl are submitting it)
        $this->sku = htmlspecialchars(strip_tags($data->sku));
        $this->name = htmlspecialchars(strip_tags($data->name));
        $this->price = htmlspecialchars(strip_tags($data->price));
        $this->type = htmlspecialchars(strip_tags($data->type));
        $this->height = htmlspecialchars(strip_tags($data->height));
        $this->width = htmlspecialchars(strip_tags($data->width));
        $this->length = htmlspecialchars(strip_tags($data->length));

        // bind data with named params
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':height', $this->height);
        $stmt->bindParam(':width', $this->width);
        $stmt->bindParam(':length', $this->length);

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