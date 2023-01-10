<?php

/**
 * Card
 * 
 */

require "callAPI.php";

// getting the parameters id if it is found, sanitize and validate
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT); // flower id

// gett  record from the table

if (isset($id)) {

    $callAPI = callAPI("/restapp/products/product/$id", "GET");
    echo $callAPI['data'];
}
