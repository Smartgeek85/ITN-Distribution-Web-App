<?php
// Database connection (MySQL in this case)
include('database/db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation to ensure fields are not empty
    if (empty($name) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;
    }

    // Check if passwords match
    if ($password !== $confirm_password) 
    {
        echo "<script>alert('Passwords do not match.');</script>";
        exit;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) 
    {
        echo "<script>alert('Username already taken.');</script>";
        exit;
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, username, password_hash) VALUES (:name, :username, :password_hash)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password_hash', $password_hash);

    if ($stmt->execute()) 
    {
        echo "<script>
                window.onload = function() {
                    alert('Registration successful! You will be redirected to the login page.');
                    window.location.href = 'index.php';
                };
              </script>";
    } 
    else 
    {
        echo "<script>alert('An error occurred. Please try again.');</script>";
    }
}
?>
