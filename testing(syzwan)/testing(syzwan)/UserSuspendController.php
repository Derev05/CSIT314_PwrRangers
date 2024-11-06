<?php
$servername = "localhost";
$username = "root"; // Update to your database username
$password = ""; // Update to your database password
$dbname = "user_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare SQL statement to update the is_suspended column
    $stmt = $conn->prepare("UPDATE users SET is_suspended = 1 WHERE id = ?");
    $stmt->bind_param("i", $userId);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User suspended successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error suspending user."]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "User ID not provided."]);
}

// Close the connection
$conn->close();
?>
