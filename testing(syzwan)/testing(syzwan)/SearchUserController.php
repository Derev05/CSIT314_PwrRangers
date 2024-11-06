<?php
$servername = "localhost";
$username = "root";        // Change to your database username
$password = "";            // Change to your database password
$dbname = "user_management";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Specify that this is a JSON response
header('Content-Type: application/json');

// Get the query from the search input
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare SQL statement
if (!empty($query)) {
    // If there is a query, search for matching usernames
    $stmt = $conn->prepare("SELECT id, username, password, contactno, email, dob, role, created_at, is_suspended FROM users WHERE username LIKE ?");
    $searchQuery = "%" . $query . "%";  // Prepare for LIKE query
    $stmt->bind_param("s", $searchQuery);
} else {
    // If no query, return all users
    $stmt = $conn->prepare("SELECT id, username, password, contactno, email, dob, role, created_at, is_suspended FROM users");
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Prepare the data as an array
$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Return the data in JSON format
echo json_encode($users);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
