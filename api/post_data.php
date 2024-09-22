<?php
header("Content-Type: application/json");

$host = "localhost";
$dbname = "itntasko_campaign";
$username = "itntasko_camp";
$password = 'eg=F2l4A=Lt6';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    http_response_code(500);
    exit;
}

// Function to generate a random ID with no consecutive identical characters
function generateRandomHouseholdID($conn) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $idLength = 8;  // Define the length of the household_id
    $unique = false;

    while (!$unique) {
        $randomID = '';
        $previousChar = '';

        for ($i = 0; $i < $idLength; $i++) {
            $randomChar = $characters[rand(0, strlen($characters) - 1)];
            
            // Ensure no consecutive identical characters
            while ($randomChar === $previousChar) {
                $randomChar = $characters[rand(0, strlen($characters) - 1)];
            }

            $randomID .= $randomChar;
            $previousChar = $randomChar;
        }

        // Check if the generated ID is unique in the database
        $stmt = $conn->prepare('SELECT COUNT(*) as count FROM distribution WHERE household_id = ?');
        $stmt->bindValue(1, $randomID, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['count'] == 0) {
            $unique = true;
        }
    }

    return $randomID;
}

// Generate a unique household_id
$household_id = generateRandomHouseholdID($conn);

// Read incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Validate the received data
if (!isset($data['household_name']) || 
    !isset($data['family_members']) || !isset($data['itns_distributed']) || !isset($data['username'])) {
    echo json_encode(["error" => "Missing required fields."]);
    http_response_code(400);
    exit;
}

// Prepare the SQL statement to insert data
$stmt = $conn->prepare('INSERT INTO distribution (user_assigned, household_id, household_name, family_members, itns_distributed, distribution_date) 
                      VALUES (?, ?, ?, ?, ?, ?)');

$stmt->bindValue(1, $data['username'], PDO::PARAM_STR);
$stmt->bindValue(2, $household_id, PDO::PARAM_STR);
$stmt->bindValue(3, $data['household_name'], PDO::PARAM_STR);
$stmt->bindValue(4, $data['family_members'], PDO::PARAM_INT);
$stmt->bindValue(5, $data['itns_distributed'], PDO::PARAM_INT);
$stmt->bindValue(6, date('Y-m-d H:i:s'), PDO::PARAM_STR);

// Execute the insert query
if ($stmt->execute()) 
{
    echo json_encode(["message" => "Data successfully submitted.", "household_id" => $household_id]);
}
else 
{
    echo json_encode(["error" => "Failed to submit data."]);
    http_response_code(500);
}

?>
