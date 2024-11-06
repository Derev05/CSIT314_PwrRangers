<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Adjust this based on your MySQL settings
$password = "";     // Adjust this based on your MySQL settings
$dbname = "user_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id']; // Get the user ID from the request

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM users WHERE id = ?";

    // Initialize the prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the user ID to the SQL statement
    $stmt->bind_param("i", $userId); // "i" denotes integer type

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user: ' . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No user ID provided.']);
}
?>
