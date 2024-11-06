<?php
session_start();

// Database configuration
$servername = "localhost"; // Change to your database server if different
$username = "root";        // Change to your database username
$password = "";            // Change to your database password
$dbname = "user_management"; // Change to your database name

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle the login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging: check if user data is retrieved correctly
    if (!$user) {
        echo "User not found. Please check the username.";
        exit();
    }

    // Verify user credentials (adjusting for plain-text passwords)
    if ($user && $password === $user['password']) {
    $_SESSION['username'] = $username;
    echo 'success'; // Send success message
    exit();
} else {
    echo "Invalid username or password."; // Send error message
}


    $stmt->close();
}

// Close the database connection
$conn->close();
?>
