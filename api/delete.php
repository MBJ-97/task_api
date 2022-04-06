<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../config/Database.php');
require_once('../models/Product.php');

// Instantiate DB object + connect tot it
$database = new Database();
$db = $database->connect();

//Instantiate product class
$product = new Product($db);

// Get raw post data from POST
$data = json_decode(file_get_contents("php://input"));

//should be getter here
$product->setId($data->id);

//delete from db

if($product->delete()){
    echo json_encode(
        array('message'=> 'Post deleted!!')
    );
} else {
    echo json_encode(
        array('message' => 'Post NOT deleted!!')
    );
}