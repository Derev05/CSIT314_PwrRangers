<?php
session_start();
require_once 'UserAccount.php';

// Handle form submission directly in the controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userCreation = SignUpController::signUpUser($_POST);
}

class SignUpController {

   public static function createUser2($postData) {
    // Collect data and hash password
    $data = [
        'username' => $postData['username'],
        'password' => $postData['password'],
        'contactno' => $postData['contactno'],
        'email' => $postData['email'],
        'dob' => $postData['dob'],
        'role' => $postData['role']
    ];

    // Create UserAccount instance and call createUser method
    $user = new UserAccount();
    $result = $user->signUpUser($data);

    // Provide feedback and redirect based on the result
    if ($result) {
        $_SESSION['message'] = 'User created successfully.';
        header('Location: LoginPage.php'); // Redirect to login page
    } else {
        $_SESSION['message'] = 'Failed to create user.';
        header('Location: signUpPage.php'); // Redirect back to sign-up page on failure
    }
    exit();
}

}
?>
