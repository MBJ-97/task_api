<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../models/Furniture.php');
require_once('../models/Book.php');
require_once('../models/Disc.php');

// Get raw post data from POST
$data = json_decode(file_get_contents("php://input"));

// Should check here if the SKU is unique or not then do next steps

//get the value of type entry
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
            array('message'=> 'Post created!!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT created!!')
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
            array('message'=> 'Post created!!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT created!!')
        );
    }
} elseif($value == 'disc') {
    $disc = new Disc();

    $disc->setSku($data->sku);
    $disc->setName($data->name);
    $disc->setPrice($data->price);
    $disc->setType($data->type);
    $disc->setSize($data->size);


    if($disc->setDisc()){
        echo json_encode(
            array('message'=> 'Post created!!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT created!!')
        );
    }
} else {
    return false;
}