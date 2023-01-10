<?php

$cmd = "SELECT DISTINCT category
        FROM flower
        ORDER BY category";

$stmt = $dbh->prepare($cmd);
$success = $stmt->execute();

if ($success) {
    $categories = [];
    while ($row = $stmt->fetch()) {
        array_push($categories, ["category" => $row["category"]]);
    }

    if (!empty($categories)) {
        header("Content-Type: application/json");
        echo json_encode($categories);
    } else {
        http_response_code(204);
    }
} else {
    http_response_code(400);
}
