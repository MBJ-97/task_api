<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../config/Database.php');
require_once('../models/Product.php');


// Instantiate DB object + connect tot it
$database = new Database();
$db = $database->connect();

//Instantiate product class
$product = new Product($db);

//execute query
$results = $product->getProducts();

// check count of result
$count = $results->rowCount();

//return result depending on availability of a response
if($count > 0) {
    $res_array = [];
    $res_array['data']= [];

    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = [
            'id'=> $id,
            'sku' => $sku,
            'name' => $name,
            'price'=> $price,
            'type' => $type,
            'size' => $size
        ];

        // push to res_array
        array_push($res_array['data'], $item);
    }

    // transform to json
    echo json_encode($res_array);
} else {
    echo json_encode([
        'message' => 'No products found in DB'
    ]);
}