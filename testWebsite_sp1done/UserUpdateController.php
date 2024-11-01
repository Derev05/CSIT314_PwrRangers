<?php
require_once 'UserAccount.php';

try {
    // Establish database connection
    $db = new PDO("mysql:host=localhost;dbname=user_management", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve data from POST request
        $data = [
            'id' => $_POST['userId'],                      // User ID
            'username' => $_POST['username'],              // Username
            'password' => $_POST['password'],              // Password (ensure secure handling in production)
            'contactno' => $_POST['contactno'],            // Contact Number
            'email' => $_POST['email'],                    // Email Address
            'dob' => $_POST['dob'],                        // Date of Birth
            'role' => $_POST['role'],                      // Role
            'is_suspended' => $_POST['isSuspended']        // Suspend status (1 if checked, 0 if unchecked)
        ];

        // Call updateUser in UserAccount.php to update the user's information
        $result = UserAccount::updateUser($db, $data);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
