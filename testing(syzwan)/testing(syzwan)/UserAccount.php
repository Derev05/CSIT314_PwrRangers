
<?php
class UserAccount {
    // Variables
    public $username;
    public $password;
    public $dob;
    public $email;
    public $contactno;
    public $userprofile;
    public $isSuspended;

    // Constructors
    public function __construct() {
        $get_arguments = func_get_args();
        $no_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct' . $no_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct2($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function __construct7($username, $password, $dob, $email, $contactno, $userprofile, $isSuspended) {
        $this->username = $username;
        $this->password = $password;
        $this->dob = $dob;
        $this->email = $email;
        $this->contactno = $contactno;
        $this->userprofile = $userprofile;
        $this->isSuspended = $isSuspended;
    }

    // Function to find a user by username (for login authentication)
    public function loginAuth($username, $password) {
        return $this->getUserByUsername($username, $password);
    }

    // Function to retrieve user by username and password (SQL interaction)
    public function getUserByUsername($username, $password) {
        $conn = $this->connectDB();
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Centralized method to handle database connection
    private function connectDB() {
        $conn = new mysqli("localhost", "root", "", "user_management");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Function to search users based on query
    public function searchUsers($query) {
        $conn = $this->connectDB();
        $sql = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeQuery = "%" . $query . "%";
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // Function to suspend a user account by ID
    public function suspendUser($userId) {
        $conn = $this->connectDB();
        $query = "UPDATE users SET is_suspended = 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    // Function to update a user account
    public function updateUser($data) {
        $conn = $this->connectDB();
        $query = "UPDATE users SET username = ?, password = ?, dob = ?, email = ?, contactno = ?, userprofile = ?, is_suspended = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssii", $data['username'], $data['password'], $data['dob'], $data['email'], $data['contactno'], $data['userprofile'], $data['is_suspended'], $data['id']);
        return $stmt->execute();
    }

    // Function to delete a user account
    public function deleteUser($userId) {
        $conn = $this->connectDB();
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    // Getters for UserAccount properties
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getDOB() { return $this->dob; }
    public function getContactNo() { return $this->contactno; }
    public function getUserprofile() { return $this->userprofile; }
    public function getSuspensionStatus() { return $this->isSuspended; }
}
?>
