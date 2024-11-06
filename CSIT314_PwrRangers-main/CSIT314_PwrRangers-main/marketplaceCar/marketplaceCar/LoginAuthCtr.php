<?php
require_once 'UserAccount.php';

class LoginAuthCtr {
	private $servername;
	private $username;
	private $password;
	private $db;
	private $conn;
	
	public function __construct() {
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->db = "users";
	
		$this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db);
		
		if($this->conn->connect_error){
			die("Connection failed: " . $this->conn->connect_error);
		}
		
		session_start();
	}
	
	public function loginAuth($username, $password) {
		$userData = $this->findUserByUsername($username);
		
		if($userData){
			$user = new UserAccount($userData['username'], $userData['password']);
			
			if($password === $user->getPassword()) {
				echo 'Login success';
				
				$_SESSION['username'] = $user->getUsername();
				$_SESSION['logged_in'] = true;
				
				header('Location: index.php');
				exit;
			} else {
				echo 'Invalid password.';
			}
		} else {
			echo 'User not found.';
		}
	}
	
 // Function to find the user by username (handles SQL)
    private function findUserByUsername($username) {
        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM useraccount WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username); // "s" means the parameter is a string
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Fetch the user data from the result
        return $result->fetch_assoc();
    }

    // Close the database connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }
}

// Handle form submission directly in the controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new LoginAuthCtr();
    $authController->loginAuth($_POST['username'], $_POST['password']);
}	
	
	
	
	