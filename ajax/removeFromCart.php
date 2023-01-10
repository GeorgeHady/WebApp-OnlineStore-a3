<?php

/**
 * - Get quantity
 * - INCREASE the inventory quantity by ONE
 * - REMOVE product to the Cart 
 * 
 */

require "TheSession.php";
require "callAPI.php";

// getting the parameters id if it is found, sanitize and validate
$cartID = filter_input(INPUT_POST, "cartID", FILTER_SANITIZE_NUMBER_INT);
$flowerID = filter_input(INPUT_POST, "flowerID", FILTER_SANITIZE_NUMBER_INT);

if (isset($flowerID) and isset($cartID)) {

    // get current quantity
    $callAPI = callAPI("/restapp/products/product/$flowerID", "GET");

    $newQuantity = json_decode($callAPI['data'])->quantity + 1;

    // INCREASE(+) the product quantity by ONE in the product/flower table
    $callAPI = callAPI(
        "/restapp/product/quantity/$flowerID/$newQuantity",
        "PUT"
    );

    //REMOVE(-) from cart table
    $callAPI = callAPI("/restapp/cart/remove/" . $cartID, "DELETE");
}
