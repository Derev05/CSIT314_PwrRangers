<?php
class UserAccount {
    // Static method to handle database connection
    private static function connectDB() {
        $conn = new mysqli("localhost", "root", "", "user_management");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Static method to create a new user account
    public static function createUser($db, $data) {
    try {
        $query = "INSERT INTO users (username, password, contactno, email, dob, role, is_suspended)
                  VALUES (:username, :password, :contactno, :email, :dob, :role, :is_suspended)";

        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $data['password']); // Consider hashing for production
        $stmt->bindParam(':contactno', $data['contactno']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':is_suspended', $data['is_suspended'], PDO::PARAM_INT);

        // Execute insert statement
        return $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        return false;
    }
}


    // Static method to retrieve user by username and password (for login authentication)
    public static function loginAuth($username, $password) {
        $conn = self::connectDB();
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Static method to search users based on query
    public static function searchUsers($query) {
        $conn = self::connectDB();
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

    public static function createUser2($conn, $data) {
    $query = "INSERT INTO users (username, password, contactno, email, dob, role)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssss",
        $data['username'],
        $data['password'],
        $data['contactno'],
        $data['email'],
        $data['dob'],
        $data['role']
    );

    return $stmt->execute();
}

    // Static method to suspend a user account by ID
    public static function suspendUser($userId) {
        $conn = self::connectDB();
        $query = "UPDATE users SET is_suspended = 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    // Static method to update a user account
    public static function updateUser($db, $data) {
    try {
        $query = "UPDATE users SET 
                    username = :username, 
                    password = :password, 
                    contactno = :contactno, 
                    email = :email, 
                    dob = :dob, 
                    role = :role, 
                    is_suspended = :is_suspended 
                  WHERE id = :id";
                  
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':contactno', $data['contactno']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':is_suspended', $data['is_suspended']); // Bind is_suspended as integer
        $stmt->bindParam(':id', $data['id']);

        // Execute update
        return $stmt->execute();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        return false;
    }
}



    // Static method to delete a user account
    public static function deleteUser($userId) {
        $conn = self::connectDB();
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }


    public static function getUserById($db, $userId) {
    try {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetching the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : null;
    } catch (PDOException $e) {
        // Handle error
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        return null;
    }
}

    // Static getters for properties, if needed, could be defined here based on use case
}
?>
