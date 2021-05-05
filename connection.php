<?php

error_reporting(E_ALL);
ini_set('display_errors'. 1);

$servername = 'localhost';
$username = "nguyenm26";
$password = "V00873715";
$database = "project_nguyenm26";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die ("Connection failed: " . $exception->getMessage());
}