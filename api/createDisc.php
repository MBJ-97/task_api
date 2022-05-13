<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include('../models/Records.php');
include('../models/Disc.php');

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
$disc = new Disc();

$disc->setSku($data->sku);
$disc->setName($data->name);
$disc->setPrice($data->price);
$disc->setType($data->type);
$disc->setSize($data->size);


if($disc->setDisc()){
    echo json_encode(
        array('message'=> 'Disc added !')
    );
} else {
    echo json_encode(
        array('message' => 'Disc NOT created!!')
    );
}
