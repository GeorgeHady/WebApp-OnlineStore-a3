<?php

/**
 * List of Products
 * 
 */

require "callAPI.php";

$category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_SPECIAL_CHARS);    // category
$listNumber = filter_input(INPUT_POST, "listNumber", FILTER_SANITIZE_NUMBER_INT);   // represent list no of 7 rows
$body = null;

if (!isset($listNumber)) {
    $listNumber = 0;
}

if (isset($category) and $category) {
    $body = json_encode(array(
        'category' => $category
    ));
}

$callAPI = callAPI("/restapp/products/" . $listNumber, "GET", $body);
$callAPICount = callAPI("/restapp/products/count", "GET", $body);

$data = json_decode($callAPI['data']);
$count = json_decode($callAPICount['data']);

array_push($data, $count);

echo json_encode($data);
