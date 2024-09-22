<?php
session_start();

// Database connection (MySQL)
include('database/db_conn.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch user from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $storedPasswordHash = $user['password_hash'];

            // Verify password
            if (password_verify($password, $storedPasswordHash)) {
                // Successful login
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                 $_SESSION['name'] = $user['name'];
                  $_SESSION['id'] = $user['id'];

                header("Location: dashboard.php");
                exit;
            } else {
                echo "<script>
        alert('Invalid username or password.');
        window.location.href = 'index.php';
    </script>";
    exit();
            }
        } else {
             echo "<script>
        alert('Invalid username or password.');
        window.location.href = 'index.php';
    </script>";
    exit();
        }
    }

?>