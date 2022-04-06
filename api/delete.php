<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../config/Database.php');
require_once('../models/Product.php');



//Instantiate product class
$product = new Database();

// Get raw post data from POST
$data = json_decode(file_get_contents("php://input"));


//delete from db

if($product->delete($data->id)){
    echo json_encode(
        array('message'=> 'Post deleted!!')
    );
} else {
    echo json_encode(
        array('message' => 'Post NOT deleted!!')
    );
}