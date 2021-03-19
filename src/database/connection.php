<?php

$servername = "localhost";
$username = "root";
$passwordb = "";
$mydb = "veterinaria";
$status = "";
$message = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $passwordb);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $status = "Success";
} catch (PDOException $e) {
    $status = "Error";
    $message = $e->getMessage();
}

?>
