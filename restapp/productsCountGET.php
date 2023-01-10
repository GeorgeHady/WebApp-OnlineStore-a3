<?php

/**
 * Get the product count by category
 * 
 */

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {     //spicefice category
    $cmd = "SELECT count(*) as 'count'
    FROM flower
    WHERE category = ?";

    $stmt = $dbh->prepare($cmd);
    $success = $stmt->execute([$data['category']]);
} else {
    $cmd = "SELECT count(*) as 'count'
        FROM flower";

    $stmt = $dbh->prepare($cmd);
    $success = $stmt->execute();
}

if ($success) {

    $count =  $stmt->fetch();
    header("Content-Type: application/json");
    echo json_encode($count);

    if (empty($count)) {
        http_response_code(204);
    }
} else {
    http_response_code(400);
}
