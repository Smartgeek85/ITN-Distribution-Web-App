<?php
header("Content-Type: application/json");

// Database connection parameters
$host = "localhost";
$dbname = "itntasko_campaign";
$username = "itntasko_camp";
$password = 'eg=F2l4A=Lt6';

try {
    // Connect to the MySQL database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    http_response_code(500);
    exit;
}

// Query to fetch all submitted records
$query = "SELECT * FROM distribution";
$results = $conn->query($query);

// Prepare the response data
$data = $results->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
echo json_encode($data);
?>
