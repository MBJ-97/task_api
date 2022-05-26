<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include('../models/Records.php');
include('../models/Book.php');
include('../models/Disc.php');
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

// instanciate classes
$DISC = new Disc();
$BOOK = new Book();
$FURNITURE = new Furniture();

//Check the post request and see which type is submitted
$type= $data->type;

if ($type === 'disc'){
    $DISC->create($data);
    echo json_encode(
        array('message'=> 'Disk added !')
    );
} elseif ($type === 'book'){
    $BOOK->create($data);
    echo json_encode(
        array('message'=> 'Book added !')
    );
} elseif ($type === 'furniture'){
    $FURNITURE->create($data);
    echo json_encode(
        array('message'=> 'Furniture added !')
    );
}