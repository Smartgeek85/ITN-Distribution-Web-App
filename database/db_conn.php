<?php

$host = "localhost";
$dbname = "itntasko_campaign";
$username = "itntasko_camp";
$password = 'eg=F2l4A=Lt6';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>