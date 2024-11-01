<?php
require_once 'UserAccount.php';

try {
    // Establish database connection
    $db = new PDO("mysql:host=localhost;dbname=user_management", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data from POST request
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'contactno' => $_POST['contactno'],
            'email' => $_POST['email'],
            'dob' => $_POST['dob'],
            'role' => $_POST['role'],
            'is_suspended' => $_POST['isSuspended'] // Set to 1 if checked, 0 otherwise
        ];

        // Call createUser method in UserAccount.php to add the new user
        $result = UserAccount::createUser($db, $data);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'User created successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
