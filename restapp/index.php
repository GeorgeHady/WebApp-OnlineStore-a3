<?PHP

/**
 * Assignment a3 Server Side Programming
 * web service products with  database
 * 
 */

require "connect.php";

$server = ""; //OR your website 
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
$path = $_SERVER['REQUEST_URI'];


if ($path == $server . "/a3/restapp/products/count") { // get count of products

    if ($method == "GET") {
        include("productsCountGET.php");
    } else {
        http_response_code(405);
    }
} else if (strpos($path, $server . "/a3/restapp/products/product/") === 0) {  // get one product info (Card)

    if ($method == "GET") {
        include("productGET.php");
    } else {
        http_response_code(405);
    }
} else if (strpos($path, $server . "/a3/restapp/product/quantity/") === 0) { // update product's quantity 

    if ($method == "PUT") {
        include("productQuantityPUT.php");
    } else {
        http_response_code(405);
    }
} else if ($path == $server . "/a3/restapp/products/categories") { // found

    include("categoriesGET.php");
} else if (strpos($path, $server . "/a3/restapp/products/") === 0) { //found

    if ($method == "GET") {     // get products data (list of 7 rows)
        include("productsGET.php");
    } else {
        http_response_code(405);
    }
} else if ($path == $server . "/a3/restapp/cart") { // get all cart data (all rows)

    if ($method == "GET") {
        include("cartGET.php");
    } else {
        http_response_code(405);
    }
} else if (strpos($path, $server . "/a3/restapp/cart/add") === 0) { // cart add product

    if ($method == "POST") {
        include("cartPOST.php");
    } else {
        http_response_code(405);
    }
} else if (strpos($path, $server . "/a3/restapp/cart/remove/") === 0) { // cart remove product

    if ($method == "DELETE") {
        include("cartDELETE.php");
    } else {
        http_response_code(405);
    }
} else {
    http_response_code(400);
}
