<?php

require_once('../models/Product.php');

class Records extends Product
{
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

    public function findOneBySku($sku)
    {
        $query = 'SELECT * FROM products WHERE sku = :sku';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //sanitize data
        $sku = htmlspecialchars(strip_tags($sku));
        $stmt->bindParam(':sku', $sku);
        // execute query
        $stmt->execute();

        return $stmt;
    }
}