<?php   //remove from the cart

$cartID = substr($path, strlen($server . '/a3/restapp/cart/remove/'));

$cmd = "SELECT *
        FROM cart
        WHERE cartID = ?";

$stmt = $dbh->prepare($cmd);
$stmt->execute([$cartID]);

if ($stmt->fetch()) {

    $cmd = "DELETE FROM cart
            WHERE cartID = ?";

    $stmt = $dbh->prepare($cmd);
    $stmt->execute([$cartID]);

    http_response_code(204);
} else {

    http_response_code(304);
}

