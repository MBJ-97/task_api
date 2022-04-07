<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../models/Records.php');
require_once('../models/Product.php');


//Instantiate product class
$record = new Records();

// Get raw post data from POST
$data = json_decode(file_get_contents("php://input"));

// get all ids from req and then loop through them and call $record->delete($id)
// for each one then echo message
$arr = $data->id;
for ($i= 0; $i < count($arr); $i++){
    if($record->delete($arr[$i])){
        echo json_encode(
            array('message'=> 'Post deleted!!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT deleted!!')
        );
    }
};