<?php

/**
 * Cart
 * 
 */

require "TheSession.php";
require "callAPI.php";

$body = json_encode(array('userSessionID' => $userSessionID));
$callAPI = callAPI("/restapp/cart", "GET", $body);

echo $callAPI['data'];
