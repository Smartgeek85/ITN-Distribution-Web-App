<?php
header("Content-Type: application/json");

$host = "localhost";
$dbname = "itntasko_campaign";
$username = "itntasko_camp";
$password = 'eg=F2l4A=Lt6';

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 

catch (PDOException $e) 

{
    // If connection fails, return an error message
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    http_response_code(500);
    exit;
}

// Query to retrieve all data from the distribution table
$query = "SELECT household_id, household_name, family_members, itns_distributed, distribution_date FROM distribution";

try {
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch all results
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are results
    if (count($data) > 0) {
        // Return data as JSON
        echo json_encode($data);
    } else {
        // Return an empty array if no data is found
        echo json_encode([]);
    }
} 

catch (PDOException $e) 
{
    // Handle any errors during the query execution
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
    http_response_code(500);
}
?>
