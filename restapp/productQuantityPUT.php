<?php

// PUT = update record (quantity)

$pathSplited = explode('/', substr($path, strlen($server . '/a3/restapp/product/quantity/')));

$id = $pathSplited[0];
$quantity = $pathSplited[1];



$cmd = "UPDATE flower                       
            SET quantity = ?
            WHERE id = ?";

$stmt = $dbh->prepare($cmd);
$params = [$quantity, $id];
$stmt->execute($params);
http_response_code(204);
