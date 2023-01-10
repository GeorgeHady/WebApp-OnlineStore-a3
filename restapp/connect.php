<?php


/**
 * connect to MySQL database on XAMPP
 * 
 * it will be included in other php files
 * 
 */

try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=DATABASE_NAME",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
