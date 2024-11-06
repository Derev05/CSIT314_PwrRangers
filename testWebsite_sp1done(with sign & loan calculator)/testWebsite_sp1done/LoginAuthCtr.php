<?php
session_start();
require_once 'UserAccount.php';

// Handle form submission directly in the controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new LoginAuthCtr();
    $authController->loginAuth($_POST['username'], $_POST['password']);
}	

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
	}
	
	public function loginAuth($username, $password) {
		$user = new UserAccount($username, $password);
		$userExists = $user->loginAuth($username, $password);		
		
		
		if($userExists) {
			//check suspension status
			$userSuspendCheck = end($userExists) ? true : false;
			if($userSuspendCheck === true){
				//if user is suspended, output message
				$_SESSION['message'] = 'Your account has been suspended.'; 				 
			} else {								
				$_SESSION['username'] = $username;
				$_SESSION['logged_in'] = true;
				$_SESSION['role'] = (count($userExists) >= 3) ? array_values($userExists)[count($userExists) - 3] : null;
				
				header('Location: index.php');
				exit();				
			}
		} else {
			$_SESSION['message'] = 'Invalid login credentials.';				
		}
		
		header('Location: LoginPage.php');		
		exit();
	}
	
    // Close the database connection when the object is destroyed
    public function __destruct() {
        $this->conn->close();
    }
}


?>	
	
	
	