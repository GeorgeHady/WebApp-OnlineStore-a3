<?php

$productID = substr($path, strlen($server . '/a3/restapp/products/product/')); //get list number

$cmd = "SELECT id, name, category, description, price, quantity, photo
        FROM flower
        WHERE id = ?";

$params = [$productID];
$stmt = $dbh->prepare($cmd);
$success = $stmt->execute($params);

if ($success) {
    $row = $stmt->fetch();

    if (!empty($row)) {
        $productRecord = [
            "id" => $row["id"],
            "name" => $row["name"],
            "category" => $row["category"],
            "description" => $row["description"],
            "price" => (float)$row["price"],
            "quantity" => (int)$row["quantity"],
        ];

        header("Content-Type: application/json");
        // write json encoded array to HTTP response
        echo json_encode($productRecord);
    } else {
        http_response_code(204);
    }
} else {
    http_response_code(400);
}
