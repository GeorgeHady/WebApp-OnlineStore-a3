<?php

/**
 * - Get quantity
 * - DECREASE the inventory quantity by ONE
 * - ADD product to the Cart 
 * 
 */

require "TheSession.php";
require "callAPI.php";

// getting the parameters id if it is found, sanitize and validate
$flowerID = filter_input(INPUT_POST, "flowerID", FILTER_SANITIZE_NUMBER_INT);

if (isset($flowerID)) {

    // get current quantity
    $callAPI = callAPI("/restapp/products/product/$flowerID", "GET");

    $newQuantity = json_decode($callAPI['data'])->quantity - 1;
    if ($newQuantity >= 0) {   //zero or larger after decrease quantity by one above

        // create body parameters   
        $body = json_encode(array(
            'productID' => $flowerID,
            'userSessionID' => $userSessionID
        ));

        // ADD(+) product to the Cart table
        $callAPI = callAPI(
            "/restapp/cart/add",
            "POST",
            $body
        );

        // if ($callAPI['response'] == "204") {    // which not 304 if you want to dont add same product more than one in the Cart

        // DECREASE(-) the product quantity by ONE in the product/flower table
        $callAPI = callAPI(
            "/restapp/product/quantity/$flowerID/$newQuantity",
            "PUT"
        );
        // }
    }
}
