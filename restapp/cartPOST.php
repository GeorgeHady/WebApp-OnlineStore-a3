<?php

/**
 * add product new to cart
 * 
 */

$data = json_decode(file_get_contents('php://input'), true);

// if (isset($data)) {  //if you want to dont add same product more than one in the Cart, and send 304 code for dont edit product quantity
//     $cmd = "SELECT *
//             FROM cart
//             WHERE flowerID = ?
//             And sessionID = ?";

//     $stmt = $dbh->prepare($cmd);
//     $params = [$data["productID"], $data["userSessionID"]];
//     $stmt->execute($params);

//     if ($stmt->fetch()) {
//         http_response_code(304);
//     } else {

        $cmd = "INSERT
                into cart (flowerID, sessionID)
                VALUES (? , ?)";

        $stmt = $dbh->prepare($cmd);
        $params = [$data["productID"], $data["userSessionID"]];
        $stmt->execute($params);
        http_response_code(204);
        
    // }
// }
