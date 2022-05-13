<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include('../models/Records.php');
include('../models/Book.php');

// Get raw post data from POST
$data = json_decode(file_get_contents("php://input"));

//Get req sku
$sku = $data->sku;

// verify it's existence in DB
$record = new Records();
$result = $record->findOneBySku($sku);
$row = $result->rowCount();

// Check if it is null
if($row)
{
    echo json_encode(
        ['message'=> 'This SKU is already listed in DB. Please choose another SKU.']
    );
    return false;
}

$book = new Book();

$book->setSku($data->sku);
$book->setName($data->name);
$book->setPrice($data->price);
$book->setType($data->type);
$book->setWeight($data->weight);


if($book->setBook()){
    echo json_encode(
        array('message'=> 'Book added !')
    );
} else {
    echo json_encode(
        array('message' => 'Book NOT created!!')
    );
}

