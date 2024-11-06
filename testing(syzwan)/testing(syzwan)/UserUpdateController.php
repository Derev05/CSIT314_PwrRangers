<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";  // Your database server
$username = "root";         // Your database username
$password = "";             // Your database password
$dbname = "user_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Check if the required fields are set in the POST request
if (isset($_POST['userId'], $_POST['username'], $_POST['password'], $_POST['contactno'], $_POST['email'], $_POST['dob'], $_POST['role'])) {

    // Get user data from POST
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $role = $_POST['role'];
    $isSuspended = isset($_POST['isSuspended']) ? $_POST['isSuspended'] : 0;

    // Prepare an SQL query to update the user details in the database
    $query = "UPDATE users SET username=?, password=?, contactno=?, email=?, dob=?, role=?, is_suspended=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssssii', $username, $password, $contactno, $email, $dob, $role, $isSuspended, $userId);


    // Execute the query and check if the update was successful
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating user']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If required fields are missing, return an error
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}

// Close the database connection
$conn->close();
?>
