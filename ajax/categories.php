<?php

/**
 * Categories menu
 */

require "callAPI.php";

$callAPI = callAPI("/restapp/products/categories", "GET");
echo $callAPI['data'];
