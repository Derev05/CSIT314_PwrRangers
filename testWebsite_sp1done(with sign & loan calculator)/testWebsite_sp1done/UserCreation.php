<?php
session_start();
require_once 'UserAccount.php';

// Handle form submission directly in the controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userCreation = new UserCreation2();
    $userCreation->createUser2($_POST);
}

class UserCreation2 {
    private $servername;
    private $username;
    private $password;
    private $db;
    private $conn;

    public function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db = "user_management";

        // Establish connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

   public function createUser2($postData) {
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
    $result = $user->createUser2($this->conn, $data);

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


    // Close the database connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }
}
?>
