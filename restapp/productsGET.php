<?php

/**
 * get products list filtered by category and list number
 * 
 */


$list = substr($path, strlen($server . '/a3/restapp/products/')); //get list number
$data = json_decode(file_get_contents('php://input'), true);

if ($list === "") {
    $list = 0;
}
$list *= 7; //starting number

$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);  //use this to enter list throw params not directly in cmd

if (isset($data)) {     //spicefice category
    $cmd = "SELECT id, name, category, description, price, quantity, photo
            FROM flower
            WHERE category = ?
            ORDER BY name
            LIMIT ?, 7";

    $params = [$data['category'], $list];
    $stmt = $dbh->prepare($cmd);
    $success = $stmt->execute($params);
} else {
    $cmd = "SELECT id, name, category, description, price, quantity, photo
            FROM flower
            ORDER BY name
            LIMIT ?, 7";

    $params = [$list];
    $stmt = $dbh->prepare($cmd);
    $success = $stmt->execute($params);
}

if ($success) {
    $products = [];
    while ($row = $stmt->fetch()) {
        array_push($products, [
            "id" => $row["id"],
            "name" => $row["name"],
            "category" => $row["category"],
            "description" => $row["description"],
            "price" => (float)$row["price"],
            "quantity" => (int)$row["quantity"],
        ]);
    }

    if (!empty($products)) {
        header("Content-Type: application/json");
        echo json_encode($products);
    } else {
        http_response_code(204);
    }
} else {
    http_response_code(400);
}
