<?php   //get all Cart data


$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {
    $cmd = "SELECT id, name, price, cart.cartID
            FROM flower
            INNER JOIN cart
            on flower.id = cart.flowerID
            WHERE cart.sessionID = ?";

    $params = [$data["userSessionID"]];
    $stmt = $dbh->prepare($cmd);
    $success = $stmt->execute($params);

    if ($success) {
        $cartData = [];
        while ($row = $stmt->fetch()) {
            array_push($cartData, [
                "cartID" => $row["cartID"],
                "flowerID" => $row["id"],
                "name" => $row["name"],
                "price" => (float)$row["price"],
            ]);
        }

      //  if (!empty($cartData)) {
            header("Content-Type: application/json");
            echo json_encode($cartData);
        // } else {
        //     http_response_code(204);
        // }
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(400);
}

