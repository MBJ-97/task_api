<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include('../models/Records.php');
include('../models/Furniture.php');

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

//Create the record
$fur = new Furniture();
$fur->setSku($data->sku);
$fur->setName($data->name);
$fur->setPrice($data->price);
$fur->setType($data->type);
$fur->setHeight($data->height);
$fur->setWidth(number_format($data->width, 2, '.', '')); //number_format($data->weight, 2, '.', '')
$fur->setLength($data->length);

if($fur->setFurniture()){
    echo json_encode(
        array('message'=> 'Furniture added !')
    );
} else {
    echo json_encode(
        array('message' => 'Furniture NOT created!!')
    );
}