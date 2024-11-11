<?php
session_start();
require_once '../entity/AgentReviews.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the session username (the review author)
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

    if (!$username) {
        echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
        exit;
    }

    // Ensure agentName is collected from the POST data
    $agentName = isset($_POST['agentName']) ? $_POST['agentName'] : null;

    if (!$agentName) {
        echo json_encode(['success' => false, 'message' => 'Agent name is required.']);
        exit;
    }

    // Collect review data from the request
    $data = [
        'id' => $_POST['reviewId'],
        'reviewRating' => $_POST['reviewRating'],
        'reviewDesc' => $_POST['reviewDesc'],
        'reviewName' => $username,
        'agentName' => $agentName  // Include agent name in the data array
    ];

    // Update the review in the database
    $result = AgentReviews::updateReview($data);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Review updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update review.']);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}
