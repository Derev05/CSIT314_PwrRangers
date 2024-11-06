<?php
require_once 'UserAccount.php';

try {
    // Establish database connection
    $db = new PDO("mysql:host=localhost;dbname=user_management", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        
        // Call the getUserById method
        $user = UserAccount::getUserById($db, $userId);

        if ($user) {
            // Send user data as JSON
            echo json_encode($user);
        } else {
            // Return a message if user not found
            echo json_encode(['success' => false, 'message' => 'User not found.']);
        }
    } else {
        // Return a message if no user ID is provided
        echo json_encode(['success' => false, 'message' => 'No user ID provided.']);
    }

} catch (PDOException $e) {
    // Return an error message if there's a database connection issue
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
