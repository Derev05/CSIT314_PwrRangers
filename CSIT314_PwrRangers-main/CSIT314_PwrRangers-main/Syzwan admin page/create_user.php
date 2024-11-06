<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set Content-Type header for JSON response
header('Content-Type: application/json');

// Database connection
$servername = "localhost"; // Use your own database credentials
$username = "root";        // Database username
$password = "";            // Database password
$dbname = "user_management"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from the POST request
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;  // Directly use the password from the POST request
    $email = $_POST['email'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $role = $_POST['role'] ?? null;

    // Validate the input
    if (empty($username) || empty($password) || empty($email) || empty($dob) || empty($role)) {
        echo json_encode([
            "success" => false,
            "message" => "Please fill in all the required fields."
        ]);
        exit;
    }

    // **REMOVED HASHING**: Password is stored as plaintext (insecure)
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);  // This line is removed

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, dob, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $dob, $role);  // Directly store the plain password

    // Execute the statement
    if ($stmt->execute()) {
        // Success
        echo json_encode([
            "success" => true,
            "message" => "User added successfully."
        ]);
    } else {
        // Error in execution
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $stmt->error
        ]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}
?>
