<?php
class UsedCarListing {
	// Static method to handle database connection
    private static function connectDB() {
        $conn = new mysqli("localhost", "root", "", "cars");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
	
	public static function searchListings($query) {
        $conn = self::connectDB();
        $sql = "SELECT * FROM carlistings WHERE car_name LIKE ? OR vehType LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeQuery = "%" . $query . "%";
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $listings = [];
        while ($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
        return $listings;
    }
	
	public static function searchListingsforSeller($query, $sellerName) {
        $conn = self::connectDB();
        $sql = "SELECT * FROM carlistings WHERE (car_name LIKE ? OR vehType LIKE ?) AND seller_name = ?";
        $stmt = $conn->prepare($sql);
        $likeQuery = "%" . $query . "%";
        $stmt->bind_param("sss", $likeQuery, $likeQuery, $sellerName);
        $stmt->execute();
        $result = $stmt->get_result();
        $listings = [];
        while ($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
        return $listings;
    }
	
	public static function getListingbyId($id) {
        $conn = self::connectDB();
        $query = "SELECT * FROM carlistings WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $listingInfo = [];
        while ($row = $result->fetch_assoc()) {
            $listingInfo[] = $row;
        }
        return $listingInfo;
    }
	
	public static function updateShortlistCount($action, $listingId) {
		$conn = self::connectDB();
		// Execute different queries according to action taken
		if ($action === "increase") {
			$query = "UPDATE carlistings SET noOfShortlists = noOfShortlists + 1 WHERE id = ?";
		} elseif ($action === "decrease") {
			$query = "UPDATE carlistings SET noOfShortlists = GREATEST(noOfShortlists - 1, 0) WHERE id = ?";
		}
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $listingId);
		
		return $stmt->execute();		
	}
	
	public static function updateBuyerShortlist($action, $listingId, $buyerName) {
		$conn = self::connectDB();
		
		// Execute different queries according to action taken
		if ($action === "increase") {
			$query = "INSERT INTO user_bookmarks (username, carListingId) VALUES (?, ?); ";
		} elseif ($action === "decrease") {
			$query = "DELETE FROM user_bookmarks WHERE username = ? AND carListingId = ?";
		}
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $buyerName, $listingId);
		
		return $stmt->execute();
	}
	
	public static function checkShortListforListing($buyerName, $listingId) {
		$conn = self::connectDB();
		
		$query =  "SELECT * FROM user_bookmarks WHERE username = ? AND carListingId = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("si", $buyerName, $listingId);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		if($result->num_rows === 0) {
			return false;
		} else {
			return true;
		}
	}
	
	public static function searchBuyerShortlist($query, $buyerName) {
		$conn = self::connectDB();
		
		$sql = "SELECT c.*
				 FROM user_bookmarks ub
				 JOIN carlistings c ON ub.carListingId = c.id
				 WHERE (c.car_name LIKE ? OR c.vehType LIKE ?)
				 AND ub.username = ?";
		
		$stmt = $conn->prepare($sql);		
		$likeQuery = "%" . $query . "%";		 		
		$stmt->bind_param("sss", $likeQuery, $likeQuery, $buyerName);
		$stmt->execute();
		$result = $stmt->get_result();
        $listings = [];
        while ($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
        return $listings;
	}
}