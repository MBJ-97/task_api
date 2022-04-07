<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../models/Furniture.php');
require_once('../models/Book.php');
require_once('../models/Disc.php');
require_once('../models/Records.php');

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

// Get the value of type entry
$value = $data->type;

if ( $value == 'furniture') { // shit goes here
    $fur = new Furniture();
    $fur->setSku($data->sku);
    $fur->setName($data->name);
    $fur->setPrice($data->price);
    $fur->setType($data->type);
    $fur->setHeight($data->height);
    $fur->setWidth($data->width);
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
} elseif ($value == 'book') {
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
} elseif ($value == 'disc') {
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
} else {
    return false;
}