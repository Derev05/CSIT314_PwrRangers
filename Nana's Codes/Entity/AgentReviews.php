<?php
class AgentReviews{
    // Static method to handle database connection
    private static function connectDB() {
        $conn = new mysqli("localhost", "root", "", "reviews");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Static method to create a new review
    public static function createReview($data) {
        $conn = self::connectDB();
        $query = "INSERT INTO reviews (reviewName, agentName, reviewRating, reviewDesc)
                  VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bind_param(
            "ssis",
            $data['reviewName'],
            $data['agentName'],
            $data['reviewRating'],
            $data['reviewDesc']
        );

        // Execute insert statement
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // Static method to retrieve a review by ID
    public static function getReviewById($reviewId) {
        $conn = self::connectDB();
        $query = "SELECT * FROM reviews WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $reviewId);
        $stmt->execute();
        $result = $stmt->get_result();
        $review = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $review;
    }

    public static function getReviewsByAgentName($agentName) {
        $conn = self::connectDB();
        $query = "SELECT id, reviewName, agentName, reviewRating, reviewDesc FROM reviews WHERE agentName = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $agentName);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $reviews = [];
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    
        $stmt->close();
        $conn->close();
        return $reviews;
    }

    // Static method to retrieve all reviews
    public static function getAllReviews() {
        $conn = self::connectDB();
        $query = "SELECT * FROM reviews";
        $result = $conn->query($query);
        $reviews = [];
        
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

        $conn->close();
        return $reviews;
    }

    // Static method to search reviews by review name or agent name
    public static function searchReviews($query) {
        $conn = self::connectDB();
        $sql = "SELECT * FROM reviews WHERE reviewName LIKE ? OR agentName LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeQuery = "%" . $query . "%";
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $reviews = [];
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $reviews;
    }

    // Static method to update a review
    public static function updateReview($data) {
        $conn = self::connectDB();
        $query = "UPDATE reviews SET 
                    reviewName = ?, 
                    agentName = ?, 
                    reviewRating = ?, 
                    reviewDesc = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bind_param(
            "ssisi",
            $data['reviewName'],
            $data['agentName'],
            $data['reviewRating'],
            $data['reviewDesc'],
            $data['id']
        );

        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }


    public static function deleteReview($reviewId) {
        $conn = self::connectDB();
        $query = "DELETE FROM reviews WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $reviewId);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
