<?php
// Connection to your database
$servername = "localhost";
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "user_management"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id was sent through the query string
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // SQL query to fetch the user details
    $sql = "SELECT id, username, password, contactno, email, dob, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $user = $result->fetch_assoc();

        // Return the user data as JSON
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    $stmt->close();
}

$conn->close();
?>
