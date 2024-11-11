<?php
require_once '../entity/AgentReviews.php'; // Ensure the path is correct

header('Content-Type: application/json');

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reviewId'])) {
    $reviewId = $_POST['reviewId'];

    // Attempt to delete the review
    $isDeleted = AgentReviews::deleteReview($reviewId);

    // Check if deletion was successful
    if ($isDeleted) {
        $response = [
            'success' => true,
            'message' => 'Review deleted successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to delete review.'
        ];
    }
} else {
    // Handle cases where reviewId is not set or invalid request method
    $response = [
        'success' => false,
        'message' => 'Invalid request. Review ID is required.'
    ];
}

// Send the JSON response and ensure no other output
echo json_encode($response);
exit;
?>
